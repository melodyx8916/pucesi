<?php

class Upload extends CFormModel {

//mis variables de mi modelo de registro usuarios
    public $title;

//mis reglas de validacion para el modelo en la cual se asignan propiedades alos campos
    public function rules() {
        //nomenclatura
        return array(
            array(
                'title',
                'required',
                'message' => 'requerido',
            )
        );
    }
}
