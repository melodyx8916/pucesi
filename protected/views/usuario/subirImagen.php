<?php
/* @var $this UsuarioController */

$this->pageTitle = 'Subir Imagenes';
$this->breadcrumbs = array(
    'Panel de Control' => array('/usuario'),
    'Subir Imagenes',
);
?>
<?php echo $mensaje ?>
<div class='form'>
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'method' => 'POST',
        'action' => Yii::app()->createUrl('usuario/subirImagen'),
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data'
        ),
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true
        )
    ));
    ?>

    <div class='row'>
        <?php
        echo $form->label($model, 'title');
        echo $form->textField($model, 'title');
        echo $form->error($model, 'title', array('class' => 'text-error'));
        ?>
    </div>

    <div class='row'>
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

    <div class='row'>
        <?php echo CHtml::submitButton('Subir Imagenes', array('class' => 'btn btn-primary'));?>
    </div>

    <?php $this->endWidget(); ?>
</div>