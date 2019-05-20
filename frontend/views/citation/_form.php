<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CitationRecord */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="citation-record-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'AUTHOR_NAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'IZDANIE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TEXT')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CREATED')->textInput() ?>

    <?= $form->field($model, 'CREATED_BY')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'UPDATED')->textInput() ?>

    <?= $form->field($model, 'UPDATED_BY')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CITATION_STATUS')->dropDownList([
        '0' => 'Черновик',
        '1' => 'Опубликовано'
    ]) ?>

    <?= $form->field($model, 'REC_STATUS')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
