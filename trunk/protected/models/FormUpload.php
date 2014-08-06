<?php
//require $_SERVER['DOCUMENT_ROOT']. "/files/core.php";
class FormUpload extends CFormModel {

    public $title;
    public $images;

    public function rules() {
        return array(
            array(
                'title',
                'required',
                'message' => 'Campo Requerido'
            ),
//            array(
//                'title',
//                'match',
//                'pattern' => '/^[a-z0-9áeíóúàèìòùñ\_]+$/i',
//                'message' => 'Error solo letras y numeros'
//            ),
            array(
                'images',
                'files',
                'type' => 'jpg,gif,png',
                'wrongType' => 'Formatos Permitidos jpg, gif y png',
                'maxSize' => 1024 * 1024 * 1, //equivalencia a 1mb
                'tooLarge' => 'El tamaño de la imagen permitido 1MB',
                'allowEmpty' => true
            ),
        );
    }
}
