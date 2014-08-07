<?php
/** @var TareaController $this */
/** @var Tarea $model */
/** @var AweActiveForm $form */
Yii::app()->clientScript->scriptMap['jquery.js'] = false;
?>
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h4><i class="icon-tasks"></i>PERFIL</h4>
</div>
<div class="modal-body">
    <?php
    echo 'MIS DATOS PARA MOSTRAR';
    ?>
</div>
<div class="modal-footer">
    <?php
    $this->widget('bootstrap.widgets.TbButton', array(
        'type' => 'success',
        'icon' => 'ok',
        'label' => Yii::t('AweCrud.app', 'Guardar'),
//        'label' => $model->isNewRecord ? Yii::t('AweCrud.app', 'Create') : Yii::t('AweCrud.app', 'Save'),
        'htmlOptions' => array(
            'onClick' => 'alert("aasd")')
    ));
    ?>
    <?php
    $this->widget('bootstrap.widgets.TbButton', array(
        'icon' => 'remove',
        'label' => Yii::t('AweCrud.app', 'Cancel'),
        'htmlOptions' => array('data-dismiss' => 'modal')
    ));


    ?>
</div>