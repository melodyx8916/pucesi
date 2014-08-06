<?php

class CambiarPassword extends CFormModel {

//mis variables de mi modelo de registro usuarios
    public $password;
    public $nuevo_password;
    public $repetir_nuevo_password;

//mis reglas de validacion para el modelo en la cual se asignan propiedades alos campos
    public function rules() {

        //nomenclatura
        return [
            //todos los atributos son requeridos
            ['password,nuevo_password,repetir_nuevo_password',
                'required',
                'message' => 'son requeridos'],
            array(
                'nuevo_password,repetir_nuevo_password',
                'match',
                'pattern' => '/^[a-z0-9]+$/i',
                'message' => 'Solo letras y numeros',
            ),
            array(
                'repetir_nuevo_password',
                'compare',
                'compareAttribute' => 'nuevo_password',
                'message' => 'El password no coincide',
            ),
        ];

//        //con array
//        return array(
//            //todos los atributos son requeridos
//            array('password,repetir_password,repetir_nuevo_password',
//                'required',
//                'message' => 'son requeridos'),
//        );
    }

}
