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
use app\models\Prerrequisito;

use app\utilities\OperacionesCurso;

class AdministrarController extends \yii\web\Controller
{
    public function actionAgregar()
    {
        $model = new Curso;
        if ($model->load(Yii::$app->request->post())) {
            if($model->validate()){
              if(OperacionesCurso::creditos_otorgados_validos($model->creditos)){
                if(OperacionesCurso::agregar_curso($model->codigo,$model->nombre,$model->creditos,$model->inicio_rama,$model->obligatorio,$model->creditos_necesarios,$model->area)){
                    Yii::$app->session->setFlash('success', "Bien, ha agregado el curso de manera exitosa!");
                }
                else{
                    Yii::$app->getSession()->setFlash('Error', 'No es posible agregar el curso');
                }
              }else{
                  Yii::$app->getSession()->setFlash('Error', 'No es posible agregar el curso, la cantidad de creditos asignada no es valida');
              }
            }
            else{
                Yii::$app->getSession()->setFlash('Error', 'No es posible agregar la categoria. Problemas de validacion del modelo');
            }
            return $this->render('agregar', ['model' => $model]);
        } else {
            // la página es mostrada inicialmente o hay algún error de validación
            return $this->render('agregar', ['model' => $model]);
        }
        //return $this->render('agregar');
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionPrerequisitos()
    {
      $model = new Prerrequisito;
      if ($model->load(Yii::$app->request->post())) {
          if($model->validate()){
              if(OperacionesCurso::agregar_prerrequisto($model->pre,$model->post)){
                  Yii::$app->session->setFlash('success', "Bien, ha agregado el pre-requisito de manera exitosa!");
              }
              else{
                  Yii::$app->getSession()->setFlash('Error', 'No es posible agregar el pre-requisito');
              }
          }
          else{
              Yii::$app->getSession()->setFlash('Error', 'No es posible agregar la categoria. Problemas de validacion del modelo');
          }
          return $this->render('prerequisitos', ['model' => $model]);
      } else {
          // la página es mostrada inicialmente o hay algún error de validación
          return $this->render('prerequisitos', ['model' => $model]);
      }
        //return $this->render('prerequisitos');
    }

}
