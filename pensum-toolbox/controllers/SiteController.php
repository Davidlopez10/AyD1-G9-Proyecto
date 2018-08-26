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

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        // ACA SE DEBE OBTENER EL CARNET DE USUARIO LOGUEADO
        $carnet_usuario = 209900909; // USUARIO DE PRUEBAS
        $data_arrs = Dashboard::get_cursos($carnet_usuario);

        $suma_creditos = OperacionesCreditos::get_total_creditos_usuario($carnet_usuario);
        $modalidades = OperacionesCreditos::get_modalidades_disponibles($suma_creditos);

        return $this->render('index', [
            'data_arrs' => $data_arrs,
            'suma_creditos' => $suma_creditos,
            'carnet_usuario' => $carnet_usuario,
            'modalidades' => $modalidades,
        ]);
        //return $this->render('index');
    }

    public function actionAprobarCurso($codigo_curso){
        // ACA SE DEBE OBTENER EL CARNET DE USUARIO LOGUEADO
        $carnet_usuario = 209900909; // USUARIO DE PRUEBAS

        $curso_row = Curso::find()->where('codigo = :codigo', [':codigo' => $codigo_curso])->one();
        if(OperacionesCurso::marcar_como_aprobado($codigo_curso, $carnet_usuario)){
            Yii::$app->session->setFlash('success', "Marcado como aprobado el curso: ".$curso_row->codigo." ".$curso_row->nombre);
        } else {
            Yii::$app->getSession()->setFlash('error', 'No es posible marcar como aprobado el curso: '.$curso_row->codigo." ".$curso_row->nombre.", no se cumple con los prerrequisitos");
        } // else

        return $this->redirect(['index']);
    }

    public function actionNoAprobarCurso($codigo_curso){
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

    public function actionRetraUnica($codigo_curso){
        // ACA SE DEBE OBTENER EL CARNET DE USUARIO LOGUEADO
        $carnet_usuario = 209900909; // USUARIO DE PRUEBAS

        $curso_row = Curso::find()->where('codigo = :codigo', [':codigo' => $codigo_curso])->one();
        if(OperacionesCurso::marcar_como_retra_unica($codigo_curso, $carnet_usuario)){
            Yii::$app->session->setFlash('success', "Marcado como retra unica el curso: ".$curso_row->codigo." ".$curso_row->nombre);
        } else {
            Yii::$app->getSession()->setFlash('error', 'No es posible marcar como retra-unica el curso: '.$curso_row->codigo." ".$curso_row->nombre.", no se cumple con los prerrequisitos");
        } // else

        return $this->redirect(['index']);
    }

    public function actionPrePost($codigo_curso){
        // ACA SE DEBE OBTENER EL CARNET DE USUARIO LOGUEADO
        $carnet_usuario = 209900909; // USUARIO DE PRUEBAS

        $curso_row = Curso::find()->where('codigo = :codigo', [':codigo' => $codigo_curso])->one();
        if(OperacionesCurso::marcar_como_pre_post($codigo_curso, $carnet_usuario)){
            Yii::$app->session->setFlash('success', "Marcado como pre-post el curso: ".$curso_row->codigo." ".$curso_row->nombre);
        } else {
            Yii::$app->getSession()->setFlash('error', 'No es posible marcar como pre-post el curso: '.$curso_row->codigo." ".$curso_row->nombre.", no se cumple con los prerrequisitos");
        } // else

        return $this->redirect(['index']);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
