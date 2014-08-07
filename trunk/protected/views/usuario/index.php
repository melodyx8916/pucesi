<?php
$this->pageTitle = 'Panel de Usuario';
$this->breadcrumbs = array(
    'Panel de Control' => array('/usuario')
);
?>
<lu>
    <li><?php echo CHtml::link('Cambiar Contraseña', Yii::app()->createUrl('usuario/cambiarPass')) ?></li>
    <li><?php echo CHtml::link('Subir Imagenes', Yii::app()->createUrl('usuario/subirImagen')) ?></li>
</lu>