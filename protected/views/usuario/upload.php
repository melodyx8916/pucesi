<?php
/* @var $this UsuarioController */

$this->pageTitle = 'Subir Imagenes';
$this->breadcrumbs = array(
    'Usuario' => array('/usuario'),
    'Subir Imagenes',
);
?>

<?php echo $mensaje ?>
<div class="form">
    <?php
//[]   ESTO TAMBIEN REPRESENTA LOS QUE ES UN ARRAY()  /  []
    $form = $this->beginWidget('CActiveForm', array(
        'method' => 'POST',
        'action' => Yii::app()->createUrl('usuario/upload'),
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data'),
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true
        )
            )
    );
    ?>
    <div class="row">
        <?php
        $this->widget('CMultiFileUpload', array(
            'model' => $model,
            'name' => 'images',
            'attribute' => 'images',
            'accept' => 'jpg|gif|png', // useful for verifying files
            'duplicate' => 'Archivo Duplicado', // useful, i think
            'denied' => 'Tipo de archivo de valido', // useful, i think
            'max' => 10
        ));
        echo $form->error($model, 'images');
        ?>
    </div>
    <div class="row">
        <?php
        //neceista echo para imprimir mi boton o cualquier cosa de todo el form
        echo CHtml::submitButton('Subir Imagen', array('class' => 'btn btn-primary'));
        ?>
    </div>



</div>
<br />
<?php // echo CHtml::submitButton('Save Changes'); ?>
<?php $this->endWidget(); ?>