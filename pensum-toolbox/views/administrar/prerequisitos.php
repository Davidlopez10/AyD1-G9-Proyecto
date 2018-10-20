<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Curso;
$this->title = 'Asignar Pre-Requisitos';
?>
<h1>Asignar Pre-requisitos</h1>
<div class="body-content">
  <div class="row">
    <div class="collapse in">
      <section class="row">
        <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'pre')->dropDownList(
            ArrayHelper::map(Curso::find()->all(),'codigo','nombre'),
            ['prompt'=>'Seleccione el curso pre-requisito']
            )?>

        <?= $form->field($model, 'post')->dropDownList(
            ArrayHelper::map(Curso::find()->all(),'codigo','nombre'),
            ['prompt'=>'Selecciones el curso que tendra el pre-requisito']
            )?>

        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>

      <?php ActiveForm::end(); ?>
      </section>
    </div>
  </div>
</div>
