<?php

namespace app\utilities;

use Yii;
use app\models\UsuarioCurso;

class OperacionesCreditos{

    public static function get_total_creditos_usuario($carnet_usuario){
        $usuario_curso_rows = UsuarioCurso::find()->where('usuario = :usuario', [':usuario' => $carnet_usuario])->andWhere('estado_curso = 2')->all();

        $suma_creditos = 0;
        foreach($usuario_curso_rows as $usuario_curso_row){
            $suma_creditos = $suma_creditos + $usuario_curso_row->curso0->creditos;
        } // foreach
        return $suma_creditos;
    } // get_total_creditos_usuario

    public static function get_modalidades_disponibles($suma_creditos){
        $modalidades = [];
        if($suma_creditos >= 33){
            $modalidades[] = "33 creditos: Logica de Sistemas, IPC1, Mate Computo 1";
        } // if
        if($suma_creditos >= 90){
            $modalidades[] = "90 creditos: Contabilidad 1, Ecologia, Legislacion 1, Psicologia Industrial";
        } // if
        if($suma_creditos >= 150){
            $modalidades[] = "150 creditos: Administracion de Empresas 1";
        } // if
        if($suma_creditos >= 170){
            $modalidades[] = "170 creditos: Seminario de Sistemas 1";
        } // if
        if($suma_creditos >= 190){
            $modalidades[] = "190 creditos: Prep. y Ev. de Proyectos 1, Seminario de Sistemas 2, Intr. a la Ev. de Impacto Ambiental";
        } // if
        if($suma_creditos >= 200){
            $modalidades[] = "200 creditos: Practica Final, Etica Profesional";
        } // if
        if($suma_creditos >= 215){
            $modalidades[] = "215 creditos: Pre-Post";
        } // if
        if($suma_creditos >= 250){
            $modalidades[] = "250 creditos: Solicitud de Cierre";
        } // if
        return $modalidades;
    } // get_modalidades_disponibles

    public static function get_total_creditosextra_usuario($carnet_usuario){
      $usuario_actividad_rows = UsuarioCurso::find()->where('usuario = :usuario', [':usuario' => $carnet_usuario])->andWhere('estado_curso = 2')->all();
      $suma_creditos = 0;
      foreach($usuario_actividad_rows as $usuario_actividad_row){
          if ($usuario_actividad_row->curso0->area ==8){
            $suma_creditos = $suma_creditos + $usuario_actividad_row->curso0->creditos;
          }
      }
      if($suma_creditos <= 7){
        return $suma_creditos;
      }
      return -1;
    }

}
