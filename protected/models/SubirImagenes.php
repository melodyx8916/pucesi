<?php
class SubirImagenes extends CFormModel {

    public $title;
    public $images;

    public function rules() {
        return array(
            array(
                'title',
                'required',
                'message' => 'Campo Requerido'
            ),
            array(
                'title',
                'match',
                'pattern' => '/^[a-z0-9áeíóúàèìòùñ\_]+$/i',
                'message' => 'Error solo letras y numeros'
            ),
            array(
                'images',
                'file',
                'types' => 'jpg,gif,png',
                'wrongType' => 'Formatos Permitidos jpg, gif y png',
                'maxSize' => 1024 * 1024 * 1, //equivalencia a 1mb
                'tooLarge' => 'El tamaño de la imagen permitido 1MB',
                'allowEmpty' => true
            )
        );
    }
}
