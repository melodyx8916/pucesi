<?php

//mi phpmailer para el envio de mensajes al correo

Yii::import('ext.phpmailer.*');

class EnviarEmail {

    public function Enviar_Email(array $from, array $to, $subject, $message) {
        $mail = new JPhpMailer;//requerido
        $mail->IsSMTP();//requerido
        $mail->Host = 'localhost';//requerido  /ejemplo/smpt.163.com
      //  $mail->SMTPAuth = true;
      //  $mail->Username = 'yourname@163.com';
      //  $mail->Password = 'yourpassword';
        $mail->SetFrom($from[0], $from[1]);//requerido
        $mail->Subject = $subject;//requerido
       // $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
        $mail->MsgHTML($message);//requerido
        $mail->AddAddress($to[0], $to[1]);//requerido
        $mail->Send();//requerido
    }

}
