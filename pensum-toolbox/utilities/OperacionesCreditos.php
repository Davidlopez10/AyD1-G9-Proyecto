<?php

namespace app\utilities;

use Yii;
use app\models\UsuarioCurso;

class OperacionesCreditos{

    public static function get_total_creditos_usuario($carnet_usuario){
        $suma_creditos = UsuarioCurso::find()->select('SUM(curso.creditos)')->joinWith('curso0')->where('usuario = :usuario', [':usuario' => $carnet_usuario])->andWhere('estado_curso = 2')->all();
        if($suma_creditos){
            return 0;
        }else{
            return $suma_creditos;
        } // else
    } // get_total_creditos_usuario
    
}