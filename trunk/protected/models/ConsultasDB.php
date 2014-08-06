<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ConsultasDB {

    //mi codigo para verificar
    public $codigo_verificacion;

    //guardar un usuario en la BDD 
    public function guardar_usuario($nombre_f, $email_f, $password_f) {
        $conexion = Yii::app()->db;

        $codigo_verificacion = $this->codigo_verificacion = sha1(rand(10000, 99999)); //mi codigo para enviar email
        /*  INSERT into tbl_user(username, email,password, codigo_verificacion)
          VALUES ('cristian','cristian@hotmail.com',1003889613,1)
         */
        $consulta = "INSERT into tbl_user(username, email,password, codigo_verificacion)";
        $consulta.= "VALUES ('" . $nombre_f . "','" . $email_f . "','" . $password_f . "','" . $codigo_verificacion . "' )";

        $resultado = $conexion->createCommand($consulta)->execute();
    }

}
