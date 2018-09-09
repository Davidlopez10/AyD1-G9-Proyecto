<?php

namespace app\controllers;

use app\utilities\OperacionesCurso;

class AsignacionController extends \yii\web\Controller
{
    public function actionIndex()
    {
      // ACA SE DEBE OBTENER EL CARNET DE USUARIO LOGUEADO
      $carnet_usuario = 209900909; // USUARIO DE PRUEBAS
      $cursos_disponibles = OperacionesCurso::get_cursos_disponibles($carnet_usuario);
      $cursos_siguientes = array();
      return $this->render('index', [
          'carnet_usuario' => $carnet_usuario,
          'cursos_disponibles' => $cursos_disponibles,
          'cursos_siguientes' => $cursos_siguientes
        ]);
    }

}
