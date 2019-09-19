<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PhotoAlbum */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="photo-album-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'TITLE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CREATED_BY')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'UPDATED_BY')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'REC_STATUS')->textInput() ?>

    <?= $form->field($model, 'SITE_LANG_ID')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
