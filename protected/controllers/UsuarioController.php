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
                'actions' => array('upload', 'configuracion'), //mi vista
                // 'actions' => array('c_datospersonales'),
                'users' => array('?'),
            )
        );
    }

    public function actionConfiguracion() {

        //creo el modelo pàra enviar ami vista

        $model = new CambiarPassword;

        $msm = null;

        if (isset($_POST['CambiarPassword'])) {
            $model->attributes = $_POST['CambiarPassword'];
            if (!$model->validate()) {
                //SI NO PASA LA VALIDACION MUESTRA EEROR
                $msm = "<strong class='text-error'>Error de cambio de contraseña</strong>";
            } else {
                //consulta para actualizar
                $conexion = Yii::app()->db;
                //valor de usuario que esta logueado
                $username = Yii::app()->user->name;

                // $consulta = "UPDATE tbl_user SET password='" . $model->nuevo_password . "' WHERE username='" . $username . "'";
                //  
                $consulta = "UPDATE tbl_user SET ";
                $consulta.="password='" . $model->nuevo_password . "' ";
                $consulta.="WHERE username='" . $username . "'";
                //   $consulta.="AND password='" . $model->password . "'";
//                var_dump($consulta);
//                die();
                $resultado = $conexion->createCommand($consulta)->execute();

                if ($resultado) {
                    $msm = "<strong class='text-info'>Se ha cambiado con Exito</strong>";
                } else {
                    $msm = "<strong class='text-info'>No se ha podido cambiar la password</strong>";
                }

                $model->password = '';
                $model->nuevo_password = '';
                $model->repetir_nuevo_password = '';
                //sino para a hacer la consulta y cambiar la contraseña
            }
        }

        //aqui se envia los datos del modelo y del mensaje a la vista
        $this->render('configuracion', array('model' => $model, 'mensaje' => $msm));
    }

    //mi controlador de mi vista upload
    public function actionUploads() {
        $model = new FormUpload;
        $msm = null;
//        var_dump($model->attributes);
//            die();
        if (isset($_POST['FormUpload'])) {
            $model->attributes = $_POST['FormUpload'];
//             var_dump($model);
//            die();
            $images = CUploadedFile::getInstancesByName('images');

            //comprobar si existen imagenes
            if (count($images) === 0) {
                $msm = "<strong class='text-info'>No ha selecionado imagenes</strong>";
            } else if (!$model->validate()) {
                $msm = "<strong class='text-info'>Error al enviar formulario</strong>";
            } else {
                //vamos a guardar
                //obtener el id del usuario actual
                $conexion = Yii::app()->db;
                //valor de usuario que esta logueado
                $username = Yii::app()->user->name;

                // SELECT id_user FROM tbl_user where username='test1'
                $consulta = "SELECT id_user FROM ";
                $consulta.="tbl_user WHERE username='$username'";
                $resultado = $conexion->createCommand($consulta);
                $registros = $resultado->query();

                //RECOGER MIS DATOS DE MI USUARIO con mi id
                foreach ($registros as $registro) {
                    $id_user = $registro['id_user'];
                }

                $folder = strtolower($model->title);
                $buscar = array(' ', 'ñ', 'á', 'é', 'í', 'ó', 'ú', 'à', 'è', 'ì', 'ò', 'ù');
                $remplazar = array('-', 'n', 'a', 'e', 'i', 'o', 'u', 'a', 'e', 'i', 'o', 'u');

                $folder = str_replace($buscar, $remplazar, $folder);

                //direccion de mi carpeta en la base
                $path = Yii::getPathOfAlias('webroot') . '/user-images/' . $id_user . '/' . $folder . '/';

//                var_dump($path);
//                die();
                //si no existe la carpeta la creamos
                if (!is_dir($path)) {
                    mkdir($path, 0, true);
                    chmod($path, 0755);
                }

                //GUARDAS LAS IMAGENES
                foreach ($images as $image => $i) {
                    //que no se repitan el nombre de las imganes
                    $aleatorio = rand(100000, 999999);
                    $img = $aleatorio . "-" . $i->name; //generar un numero acoplado al nombre de la imagen
                    //reliazar consulta de insert a la tabla para guardar la imagen

                    $consulta = "INSERT INTO tbl_imagen ";
                    $consulta.="(id_user, title, folder, image)";
                    $consulta.="VALUES";
                    $consulta.="('" . $id_user . "', '" . $model->title . "','" . $folder . "','" . $img . "')";

                    $resultado = $conexion->createCommand($consulta)->execute();
                    $i->saveAs($path . $img);
                }
            }
        }
        // $this->render('upload');  
        $this->render('upload', array('model' => $model, 'mensaje' => $msm));
    }

    public function actionUpload() {
        $model = new Upload;

        $msm = null;

        if (isset($_POST['Upload'])) {
//            var_dump($msm);
//            die();
            $model->attributes = $_POST['Upload'];

            if (!$model->validate()) {
                $msm = 'BIEN';
                var_dump($msm);
                die();
            } else {
                $msm = 'NO EXISTEN DATOS';
            }
        }
        $this->render('upload', array('model' => $model, 'mensaje' => $msm));
    }

}
