<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Area;
$this->title = 'Agregar Curso';
?>
<h1>Agregar Curso</h1>
<div class="body-content">
  <div class="row">
    <div class="collapse in">
      <section class="row">
        <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'codigo') ?>
    <?= $form->field($model, 'nombre') ?>
    <?= $form->field($model, 'creditos') ?>
    <?=$form->field($model, 'inicio_rama')->dropdownList([
            1 => 'S',
            2 => 'N'
        ],
        ['prompt'=>'Elija Una opcion']
    )?>
    <?=$form->field($model, 'obligatorio')->dropdownList([
            1 => 'S',
            2 => 'N'
        ],
        ['prompt'=>'Elija Una opcion']
    )?>
    <?= $form->field($model, 'creditos_necesarios') ?>
    <?= $form->field($model, 'area')->dropDownList(
            ArrayHelper::map(Area::find()->all(),'id','nombre'),
            ['prompt'=>'Selecciones un area']
       )?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>
      </section>
    </div>
  </div>
</div>
