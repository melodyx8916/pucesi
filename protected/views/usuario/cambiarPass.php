<?php
/* @var $this UsuarioController */

$this->pageTitle = 'Cambiar Password';
$this->breadcrumbs = array(
    'Panel de Control' => array('/usuario'),
    'Cambiar Password',
);
?>

<?php echo $mensaje ?>
<div class="form">
    <?php
//[]   ESTO TAMBIEN REPRESENTA LOS QUE ES UN ARRAY()  /  []
    $form = $this->beginWidget('CActiveForm', [
        'method' => 'POST',
        'action' => Yii::app()->createUrl('usuario/cambiarPass'),
        'enableClientValidation' => true,
        'clientOptions' => [
            'validateOnSubmit' => true
        ]
    ]);
    ?>
    <div class="row">
        <?php
        echo $form->labelEx($model, 'password');
        echo $form->passwordField($model, 'password');
        echo $form->error($model, 'password', ['class' => 'text-error']);
        ?>
    </div>
    <div class="row">
        <?php
        echo $form->labelEx($model, 'nuevo_password');
        echo $form->passwordField($model, 'nuevo_password');
        echo $form->error($model, 'nuevo_password', ['class' => 'text-error']);
        ?>
    </div>
    <div class="row">
        <?php
        echo $form->labelEx($model, 'repetir_nuevo_password');
        echo $form->passwordField($model, 'repetir_nuevo_password');
        echo $form->error($model, 'repetir_nuevo_password', ['class' => 'text-error']);
        ?>
    </div>
    <div class="row">
        <?php
        //neceista echo para imprimir mi boton o cualquier cosa de todo el form
        echo CHtml::submitButton('guardas password', ['class' => 'btn btn-primary']);
        ?>
    </div>

</div>
<br />
<?php // echo CHtml::submitButton('Save Changes'); ?>
<?php $this->endWidget(); ?>