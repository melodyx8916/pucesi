<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity {

    /**
     * Authenticates a user.
     * The example implementation makes sure if the username and password
     * are both 'demo'.
     * In practical applications, this should be changed to authenticate
     * against some persistent user identity storage (e.g. database).
     * @return boolean whether authentication succeeds.
     */
    public function authenticate() {
        //RELIAZAR LA CONSULTA
//        SELECT username, password FROM tbl_user
//        WHERE username = 'test1' AND
//        password = 'pass1' AND
//        activo = 1
        //en codigo para Yii.consulta
        $conexion = Yii::app()->db; //obtener la conexion
        $consulta = "SELECT username, password FROM tbl_user ";
        $consulta.= "WHERE username='" . $this->username . "' AND "; //" . $this->username . "  va a ser mi variable=username
        $consulta.= "password='" . $this->password . "' AND activo=1"; //" . $this->password . "  va a ser mi variable=password
        //ejecuta la consulta con command
        $resultado = $conexion->createCommand($consulta)->query();
        //verificar si la fila existe
        $resultado->bindColumn(1, $this->username);
        $resultado->bindColumn(2, $this->password);
        //verificar los datos
        while ($resultado->read() !== false) {
            $this->errorCode = self::ERROR_NONE;
            return !$this->errorCode;
        }
    }

}
