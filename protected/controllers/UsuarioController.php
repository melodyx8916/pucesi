<?php

class UsuarioController extends Controller {

    // Uncomment the following methods and override them if needed


    public function filters() {
        //mi control de accesso para los usuarios
        return array('accessControl');
    }

    public function accessRules() {
        //mi vista configuracion esta denegada todos los usuarios ecepto quien aya logueado
        return array(
            array(
                'deny',
                'actions' => array('subirImagen', 'cambiarPass'), //mis vistas
                'users' => array('?'),
            )
        );
    }

    public function actionPerfil() {
        $this->render('Perfil');
    }

    public function actionIndex() {
        $this->render('index');
    }

    public function actionCambiarPass() {
        //creo el modelo pàra enviar ami vista
        $model = new CambiarPass;
        $msm = null;

        if (isset($_POST['CambiarPass'])) {
            $model->attributes = $_POST['CambiarPass'];
            if (!$model->validate()) {
                $msm = "<strong class='text-error'>Error de cambio de contraseña</strong>";
            } else {
                $msm = $this->updatePassword($model);
                $this->limpiarCampos($model);
            }
        }
        $this->render('CambiarPass', array('model' => $model, 'mensaje' => $msm));
    }

    public function updatePassword($model) {
        $conexion = Yii::app()->db;
        $username = Yii::app()->user->name;
// $consulta = "UPDATE tbl_user SET password='" . $model->nuevo_password . "' WHERE username='" . $username . "'";
        $consulta = "UPDATE tbl_user SET ";
        $consulta.= "password='" . $model->nuevo_password . "' ";
        $consulta.= "WHERE username='" . $username . "'";
        $resultado = $conexion->createCommand($consulta)->execute();
        if ($resultado) {  //si la consulta fue exitosa
            $msm = "<strong class='text-info'>Se ha cambiado con Exito</strong>";
        } else {
            $msm = "<strong class='text-info'>No se ha podido cambiar la password</strong>";
        }
        return $msm;
    }

    public function limpiarCampos($model) {
        $model->password = '';
        $model->nuevo_password = '';
        $model->repetir_nuevo_password = '';
    }

    //mi controlador de mi vista upload
    public function actionSubirImagen() {
        $model = new SubirImagenes;
        $msm = null;
        if (isset($_POST['SubirImagenes'])) {
            $model->attributes = $_POST['SubirImagenes'];
            $images = CUploadedFile::getInstancesByName('images');
            //comprobar si existen imagenes
            if (count($images) === 0) {
                $msm = "<strong class='text-info'>No ha selecionado imagenes</strong>";
            } else if (!$model->validate()) {
                $msm = "<strong class='text-info'>Error al enviar formulario</strong>";
            } else {
                //llamar a consulta de select tbl_user
                $datos = $this->consultaSelectTblUser();
                //RECOGER MIS DATOS DE MI USUARIO con mi id
                foreach ($datos as $registro) {
                    $id_user = $registro['id_user'];
                }
                $carpeta = $this->rutaCarpeta($model);
                //direccion de mi carpeta en la base
                $ruta = Yii::getPathOfAlias('webroot') . '/user-images/' . $id_user . '/' . $carpeta . '/';
                $this->crearCarpeta($ruta);
                //guardar imagenes
                $msm = $this->guardaImagenes($images, $model, $id_user, $carpeta, $ruta);
            }
        }
        $this->render('subirImagen', array('model' => $model, 'mensaje' => $msm));
    }

    public function consultaSelectTblUser() {
        $conexion = Yii::app()->db;
        //valor de usuario que esta logueado
        $username = Yii::app()->user->name;
        // SELECT id_user FROM tbl_user where username='test1'
        $consulta = "SELECT id_user FROM ";
        $consulta.="tbl_user WHERE username='$username'";
        $resultado = $conexion->createCommand($consulta);
        $registros = $resultado->query();
        return $registros;
    }

    public function rutaCarpeta($model) {
        $folder = strtolower($model->title);
        $buscar = array(' ', 'ñ', 'á', 'é', 'í', 'ó', 'ú', 'à', 'è', 'ì', 'ò', 'ù');
        $remplazar = array('-', 'n', 'a', 'e', 'i', 'o', 'u', 'a', 'e', 'i', 'o', 'u');
        $folder = str_replace($buscar, $remplazar, $folder);
        return $folder;
    }

    public function crearCarpeta($path) {
        //si no existe la carpeta la creamos
        if (!is_dir($path)) {
            mkdir($path, 0, true);
            chmod($path, 0755);
        }
    }

    public function guardaImagenes($images, $model, $id_user, $carpeta, $ruta) {
        $conexion = Yii::app()->db;
        foreach ($images as $image => $i) {
            $aleatorio = rand(100000, 999999);
            $img = $aleatorio . "-" . $i->name; //generar un numero acoplado al nombre de la imagen
            $consulta = "INSERT INTO tbl_image ";
            $consulta.="(id_user, title, folder, image) ";
            $consulta.="VALUES ";
            $consulta.="('" . $id_user . "', '" . $model->title . "','" . $carpeta . "','" . $img . "')";
            $conexion->createCommand($consulta)->execute();
            $i->saveAs($ruta . $img);
        }
        return $msm = "<strong class='text-info'>Se guardo correctamente las imagenes</strong>";
    }

    public function actionRegistroPerfilModal() {
        if (Yii::app()->request->isAjaxRequest) {

//             $model->owner_id = Yii::app()->user->id;
            $validadorPartial = false;
//            $model->entidad_tipo = $tipo_entidad;
//            $model->entidad_id = $id_entidad;
//            $tipo_entidad == $model->getEntidadTipoContacto() ? $model->contacto_id = $id_entidad : $model->contacto_id;
//            if (isset($_POST['Tarea'])) {
//                if (isset($_POST['Tarea']['accion'])) {
//
//                    $model->attributes = $_POST['Tarea'];
//
////                    $model->contacto_id = $_POST['cliente_id'];
////                    var_dump($model->attributes);
//////                    die();
//                    $result = $this->Crear($model);
//                }
//
//                if (!$result['success']) {
//                    $result['mensage'] = "Error al guardar la tarea";
//                }
//                $validadorPartial = TRUE;
//                echo json_encode($result);
//            }
            if (!$validadorPartial) {
                $this->renderPartial('registroPerfilModal', array('model' => 5), false, true);
            }
        } else {
            var_dump("sss");    
        }
    }

}
