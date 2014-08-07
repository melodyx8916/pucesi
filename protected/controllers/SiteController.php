<?php

class SiteController extends Controller {

    /**
     * Declares class-based actions.
     */
    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'
        $this->render('index');
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Displays the contact page
     */
    public function actionContact() {
        $model = new ContactForm;
        if (isset($_POST['ContactForm'])) {
            $model->attributes = $_POST['ContactForm'];
            if ($model->validate()) {
                $name = '=?UTF-8?B?' . base64_encode($model->name) . '?=';
                $subject = '=?UTF-8?B?' . base64_encode($model->subject) . '?=';
                $headers = "From: $name <{$model->email}>\r\n" .
                        "Reply-To: {$model->email}\r\n" .
                        "MIME-Version: 1.0\r\n" .
                        "Content-Type: text/plain; charset=UTF-8";

                mail(Yii::app()->params['adminEmail'], $subject, $model->body, $headers);
                Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
            }
        }
        $this->render('contact', array('model' => $model));
    }

    /**
     * Displays the login page
     */
    public function actionLogin() {
        $model = new LoginForm;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login())
                $this->redirect(Yii::app()->user->returnUrl);
        }
        // display the login form
        $this->render('login', array('model' => $model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

    public function actionRegistro() {

        //instanciar mi modelo
        $model = new ValidarRegistro;
        $msm = null;

        //capturar la instancia de mi ajax
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }


        //capturar el envio del formulario en el metodo $_POST de mi modelo
        if (isset($_POST['ValidarRegistro'])) {
            $model->attributes = $_POST['ValidarRegistro']; //RECOGER las validaciones de mi clase ValidarRegistro
            if (!$model->validate()) {//si no valida modelo
                //mesaje de error
                $model->addError('repetir_password', 'Error al enviar el formulario');
            } else {
                //guarda informacion y envia un correo de conformacion 

                $guardar = new ConsultasDB;
                $guardar->guardar_usuario(
                $model->nombre, $model->email, $model->password);

                // y envia un correo de conformacion 
                $subject = "Confirmar registro en " . Yii::app()->name . "";
                $message = "Para confirmar su cuenta, haga click en el";
                $message.= "Siguiente enlace...";
                $message.= "<a href='http://localhost/proyecto_boot/site/registro&username=" . $model->nombre . "&codigo_verificacion=" . $guardar->codigo_verificacion . "'>Confirmar Registro</a>";

                $email= new EnviarEmail;
                $email->Enviar_Email(
                        array(Yii::app()->params['adminEmail'],
                            Yii::app()->name), 
                        array($model->email, $model->nombre), 
                        $subject, 
                        $message);
                $model->nombre = '';
                $model->email = '';
                $model->password = '';
                $model->repetir_password = '';
                $msm = 'Hemos Enviado un Email a su correo para confirmacion';
            }
        }
        $this->render('registro', array('model' => $model, 'mensaje_envio' => $msm)); //enviar los datos a la vista con el $model
    }
    
    public function actionRecuperar_pass(){
        $this->render('recuperar_pass');
    }

}
