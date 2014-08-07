<?php

class ValidarRegistro extends CFormModel {

//mis variables de mi modelo de registro usuarios
    public $nombre;
    public $email;
    public $password;
    public $repetir_password;

//mis reglas de validacion para el modelo en la cual se asignan propiedades alos campos
    public function rules() {
        //retornar array de todas las validaciones
        return array(
            //array de propiedades de los campos 
            array(
                'nombre,password,repetir_password,email', // nombre de mis campos nombre,password,repetir_password,email
                'required',
                'message' => 'Este campo es requerido',
            ),
            array(
                'email',
                'email',
                'message' => 'El formato de Email es Incorrecto',
            ),
            array(
                'password',
                'match',
                'pattern' => '/^[a-z0-9]+$/i',
                'message' => 'Solo letras y numeros',
            ),
            array(
                'repetir_password',
                'compare',
                'compareAttribute' => 'password',
                'message' => 'El password no coincide',
            ),
            array(
                'nombre',
                'comprobar_nombre'
            ),
            array(
                'email',
                'comprobar_email'
            ),
        ); //fin de mi return array
    }

    public function attributeLabels() {
        return array(
            'nombre' => 'Ingrese Nombre/Usuario',
            'email' => 'Ingrese Correo Electronico',
            'password' => 'Ingrese Contraseña',
            'repetir_password' => 'Repetir Contraseña'
        );
    }

//fin de mi metodo de rules
    //metodo para hacer una consulta y comprobar si el nombre existe en la base de datos
    public function comprobar_nombre($attributes, $params) {
        //acceder a mi base de datos
        $conexion = Yii::app()->db;
        //SELECT username FROM tbl_user WHERE username = 'test1'
        $consulta = "SELECT username FROM tbl_user WHERE username = '" . $this->nombre . "'";
        $resultado = $conexion->createCommand($consulta);  //creo el command para la consulta
        $registros = $resultado->query(); //ejecuto la consulta
        //recoger los datos en un foreach de mi registros a registro
        foreach ($registros as $registro) {
            if ($this->nombre === $registro['username']) {//comparar el campo de mi formulario con el de mi tbl_user  del campo username
                $this->addError('nombre', 'Usuario no Disponible');
                break; //romper la ejecucion si encuentra el registro
            }
        }
    }

    //metodo para hacer una consulta y comprobar si el email existe en la base de datos
    public function comprobar_email($attributes, $params) {
        //acceder a mi base de datos
        $conexion = Yii::app()->db;
        //SELECT username FROM tbl_user WHERE username = 'test1'
        $consulta = "SELECT email FROM tbl_user WHERE email = '" . $this->email . "'";

        $resultado = $conexion->createCommand($consulta);  //creo el command para la consulta
        $registros = $resultado->query(); //ejecuto la consulta
        //recoger los datos en un foreach de mi registros a registro
        foreach ($registros as $registro) {
            if ($this->email === $registro['email']) {//comparar el campo de mi formulario con el de mi tbl_user  del campo username
                $this->addError('email', 'Email no Disponible');
                break; //romper la ejecucion si encuentra el registro
            }
        }
    }

}
