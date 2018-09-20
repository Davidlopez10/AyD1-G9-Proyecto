<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

use app\models\Curso;

use app\utilities\Dashboard;
use app\utilities\OperacionesCurso;
use app\utilities\OperacionesCreditos;

class ExtraController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $carnet_usuario = 209900909; // USUARIO DE PRUEBAS
        $actividades_disponibles = OperacionesCurso::get_actividades_disponibles($carnet_usuario);
        $cursos_disponibles = OperacionesCurso::get_cursos_disponibles($carnet_usuario);
        $usuario_cursos = OperacionesCurso::get_usuario_cursos_ae($carnet_usuario);
        $creditos_extra = OperacionesCreditos::get_total_creditosextra_usuario($carnet_usuario);
        return $this->render('index',[
          //'cursos_disponibles' => $cursos_disponibles,
          'actividades_disponibles' => $actividades_disponibles,
          'usuario_cursos' => $usuario_cursos,
          'creditos_extra' => $creditos_extra,
          'carnet_usuario' => $carnet_usuario,
        ]);

    }
    public function actionAprobarActividad($codigo_curso){
      $carnet_usuario = 209900909; // USUARIO DE PRUEBAS
      $curso_row = Curso::find()->where('codigo = :codigo', [':codigo' => $codigo_curso])->one();
      if(OperacionesCreditos::get_total_creditosextra_usuario($carnet_usuario)<7)
      {
        if(OperacionesCurso::marcar_como_aprobado($codigo_curso, $carnet_usuario)){
            Yii::$app->session->setFlash('success', "Marcado como aprobado la actividad: ".$curso_row->codigo." ".$curso_row->nombre);
        } else {
            Yii::$app->getSession()->setFlash('error', 'No es posible marcar como aprobado el curso: '.$curso_row->codigo." ".$curso_row->nombre.", usted no cumplio con los prerrequisitos para esta actividad");
        } // else
      }else{
        Yii::$app->getSession()->setFlash('error', 'No es posible marcar como aprobado el curso: '.$curso_row->codigo." ".$curso_row->nombre.", usted ya tiene 7 creditos extracurriculares aprobados");
      }
      return $this->redirect(['index']);
    }

    public function actionNoAprobarActividad($codigo_curso){
        // ACA SE DEBE OBTENER EL CARNET DE USUARIO LOGUEADO
        $carnet_usuario = 209900909; // USUARIO DE PRUEBAS

        $curso_row = Curso::find()->where('codigo = :codigo', [':codigo' => $codigo_curso])->one();
        if(OperacionesCurso::marcar_como_no_aprobado($codigo_curso, $carnet_usuario)){
            Yii::$app->session->setFlash('success', "Marcado como no aprobado el curso: ".$curso_row->codigo." ".$curso_row->nombre);
        } else {
            Yii::$app->getSession()->setFlash('error', 'No es posible marcar como no aprobado el curso: '.$curso_row->codigo." ".$curso_row->nombre.", no esta aprobado");
        } // else

        return $this->redirect(['index']);
    }
}
