<?php

namespace app\utilities;

use Yii;
use app\models\User;

class Registro{

    public static function get_longitud_contrasena($contra){
        return strlen($contra);
    } // get_longitud_contrasena

    public static function get_usuario_existe($usuario){
        $query = User::find()->where('username = :username', [':username' => $usuario]);
        return $query->count();
    } // get_usuario_existe

}
