<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */
/* @var $form ActiveForm */
?>
<div class="site-signup">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'carnet') ?>
        <?= $form->field($model, 'nombres') ?>
        <?= $form->field($model, 'apellidos') ?>
        <?= $form->field($model, 'contrasena')->passwordInput() ?>
        <?= $form->field($model, 'correo') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- site-signup -->
