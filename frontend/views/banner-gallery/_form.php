<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\BannerGallery */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="banner-gallery-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'DESCRIPTION')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'WIDTH')->textInput() ?>

    <?= $form->field($model, 'HEIGHT')->textInput() ?>

<!--    --><?//= $form->field($model, 'CREATED')->textInput() ?>

    <?= $form->field($model, 'CREATED_BY')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'UPDATED')->textInput() ?>

    <?= $form->field($model, 'UPDATED_BY')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'REC_STATUS')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
