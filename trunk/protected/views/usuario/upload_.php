<?php $this->pageTitle = 'Subir Imagenes';
$this->breadcrumbs = array('Subir Imagenes');

//echo $mensaje;
?>

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
        echo $form->label($model, 'title');
        echo $form->textField($model, 'title');
        echo $form->error($model, 'title', array('class' => 'text-error'));
        ?>
    </div>

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
        <?php//neceista echo para imprimir mi boton o cualquier cosa de todo el form
        echo CHtml::submitButton('Subir Imagen', array('class' => 'btn btn-primary'));
        ?>
    </div>

    <?php $this->endWidget(); ?>
</div>
<?php $form = $this->beginWidget('CActiveForm', array(
    'id'=>'user-form',
    'enableAjaxValidation'=>true,
    'enableClientValidation'=>true,
    'focus'=>array($model,'firstName'),
)); ?>

<?php echo $form->errorSummary($model); ?>

<div class="row">
    <?php echo $form->labelEx($model,'firstName'); ?>
    <?php echo $form->textField($model,'firstName'); ?>
    <?php echo $form->error($model,'firstName'); ?>
</div>
<div class="row">
    <?php echo $form->labelEx($model,'lastName'); ?>
    <?php echo $form->textField($model,'lastName'); ?>
    <?php echo $form->error($model,'lastName'); ?>
</div>

<?php $this->endWidget(); ?>