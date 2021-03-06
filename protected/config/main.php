<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
Yii::setPathOfAlias('bootstrap', dirname(__FILE__) . '/../extensions/bootstrap');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'PUCE-SI',
    'theme' => 'bootstrap',
    // preloading 'log' component
    'preload' => array('log'),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.extensions.*',
        'ext.yii-mail.YiiMailMessage'
    ),
    'modules' => array(
        'gii' => array(
            'generatorPaths' => array(
                'bootstrap.gii',
            ),
        ),
    // uncomment the following to enable the Gii tool
    
      'gii'=>array(
      'class'=>'system.gii.GiiModule',
      'password'=>'admin',
      // If removed, Gii defaults to localhost only. Edit carefully to taste.
      'ipFilters'=>array('127.0.0.1','::1'),
      ),
     
    ),
    // application components
    'components' => array(
        'Smtpmail'=>array(
            'class'=>'application.extensions.smtpmail.PHPMailer',
            'Host'=>"smtp.gmail.com",
            'Username'=>'cristtian8916@gmail.com',
            'Password'=>'djsistemas',
            'Mailer'=>'smtp',
            'Port'=>587,
            'SMTPAuth'=>true,
            'SMTPSecure' => 'tls',
        ),
        'bootstrap' => array(
            'class' => 'bootstrap.components.Bootstrap',
        ),
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
        ),
        // uncomment the following to enable URLs in path-format
//        'urlManager' => array(
//           // 'showScriptName' => false,
//            'urlFormat' => 'path',
//            'showScriptName' => false,
//            'rules' => array(
//                '<controller:\w+>/<id:\d+>' => '<controller>/view',
//                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
//                '<controller:\w+>/<action:\w+>$<id:\d+>$<id2:\d+>' => '<controller>/<action>',
//                '<controller:\w+>/<action:\w+>$<id:\d+>$<id2:\d+>$<id3:\d+>' => '<controller>/<action>',
//                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
//            ),
//        ),
        'db' => array(
            'connectionString' => 'sqlite:' . dirname(__FILE__) . '/../data/testdrive.db',
        ),
        // uncomment the following to use a MySQL database
        'db' => array(
            'class' => 'CDbConnection',
            'connectionString' => 'mysql:host=localhost;dbname=imagenup',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
            // uncomment the following to show log messages on web pages
            /*
              array(
              'class'=>'CWebLogRoute',
              ),
             */
            ),
        ),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        
        'adminEmail' => 'crittian8916@gmail.com',
    ),
);
