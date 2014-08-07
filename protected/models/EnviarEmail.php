<?php

class EnviarEmail {

    public function Enviar_Email(array $from, array $to, $subject, $message) {
        $mail = Yii::app()->Smtpmail;
        $mail->SetFrom($from[0], $from[1]); //requerido
        $mail->Subject = $subject; //requerido
        $mail->MsgHTML($message); //requerido
        $mail->AddAddress($to[0], $to[1]); //requerido
        $mail->Send(); //requerido
        $msm = null;
        if (!$mail->Send()) {
            $msm = Yii::app()->user->setFlash('error', 'email no valido' . $mail->ErrorInfo);
        } else {
            $msm = Yii::app()->user->setFlash('success', 'correo enviado');
        }
        return $msm;
    }

}
