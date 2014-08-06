<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//para registrar mis propios datos en la base de datos

$this->pageTitle = 'Formulario de Registro de Usuarios';
//MI MENU seguimiento
$this->breadcrumbs = array('registro');
?>

<h3>FORMULARIO DE REGISTRO</h3>

<strong class="text-info"><?php echo $mensaje_envio;?></strong>

<div>
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'method' => 'post',
        'action' => Yii::app()->createUrl('site/registro'), //accion hacia el registro
        'id' => 'form',
        'enableClientValidation' => true, //activacion de validacion en el cliente
        'enableAjaxValidation' => true, // activar validacion en ajax
        'clientOptions' => array(
            'validateOnSubmit' => true,
        )
    ));
    ?>

    <!--campo de usuario -->
    <div class="row">
        <?php
        echo $form->labelEx($model, 'nombre');
        echo $form->textField($model, 'nombre');
        echo $form->error($model, 'nombre', array('class' => 'text-error'));
        ?>
    </div>
    <!--campo de email -->
    <div class="row">
        <?php
        echo $form->labelEx($model, 'email');
        echo $form->textField($model, 'email');
        echo $form->error($model, 'email', array('class' => 'text-error'));
        ?>
    </div>
    <!--campo de clave -->
    <div class="row">
        <?php
        echo $form->labelEx($model, 'password');
        echo $form->passwordField($model, 'password');
        echo $form->error($model, 'password', array('class' => 'text-error'));
        ?>
    </div>
    <!--campo de repetir -->
    <div class="row">
        <?php
        echo $form->labelEx($model, 'repetir_password');
        echo $form->passwordField($model, 'repetir_password');
        echo $form->error($model, 'repetir_password', array('class' => 'text-error'));
        ?>
    </div>
    <!--boton de registrarme -->
    <div class="row">
        <?php
        echo CHtml::submitButton("Registrarme", array('class' => 'btn btn-primary'));
        ?>
    </div>

<?php $this->endWidget(); ?>
</div>