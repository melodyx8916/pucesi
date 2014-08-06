<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />

        <!-- AQUI VA MIS LINEAS PARA INCLUIR MIS ARCHIVOS PARA LOS BOOTSTRAP-->

        <?php
        echo Yii::app()->bootstrap->registerAllCss();
        echo Yii::app()->bootstrap->registerCoreScripts();
        ?>

        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    </head>

    <body>

        <!--<div class="container" id="page">-->

        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <!-- aplicar contenido de mi boton responsive-->

                    <button type="button" class="btn btn-navbar" data-toogle="collapse" data-toogle=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="brand" href="<?php echo Yii::app()->homeUrl ?>">
                        <?php echo CHtml::encode(Yii::app()->name) ?>
                    </a>
                    <div class="nav-collapse collapse">
                        <?php
                        $this->widget('bootstrap.widgets.TbMenu', array(
                            'items' => array(
                                array('label' => 'Home', 'url' => array('/site/index'), 'visible' => !Yii::app()->user->isGuest),
                                array('label' => 'About', 'url' => array('/site/page', 'view' => 'about'), 'visible' => !Yii::app()->user->isGuest),
                                array('label' => 'Contact', 'url' => array('/site/contact'), 'visible' => !Yii::app()->user->isGuest),
                                array('label' => 'Registrarme', 'url' => array('/site/registro'), 'visible' => Yii::app()->user->isGuest),
                                array('label' => 'Iniciar Sesion', 'url' => array('/site/login'), 'visible' => Yii::app()->user->isGuest),
                                array('label' => 'Panel de Control', 'visible' => !Yii::app()->user->isGuest,
                                    'items' => array(
                                        array('label' => 'Configuracion', 'url' => array('/usuario/configuracion')),
                                        array('label'=>'Subir Imagenes', 'url'=>array('/usuario/upload'))
                                    ),
                                ),
                                array('label' => 'Cerrar Sesion (' . Yii::app()->user->name . ')', 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest)
                            ),
                            'htmlOptions' => array('class' => 'nav navbar-nav'),
                        ));
                        ?>
                    </div>
                </div>
            </div>
        </div>
        </div><!-- mainmenu -->

        <div class="container">
            <div class="page-header"
                 <br></br>
                <br></br>
                <?php if (isset($this->breadcrumbs)): ?>
                    <?php
                    $this->widget('zii.widgets.CBreadcrumbs', array(
                        'links' => $this->breadcrumbs,
                    ));
                    ?><!-- breadcrumbs -->
                <?php endif ?>
            </div>
            <?php echo $content; ?>

            <div class="clear"></div>
            <div class="footer text-center">
                Copyright &copy; <?php echo date('Y'); ?> by DjSiSteMas.<br/>
                All Rights Reserved.<br/>
                <?php echo Yii::powered(); ?>
            </div><!-- footer -->

            <!--</div> page -->
        </div>
    </body>
</html>
