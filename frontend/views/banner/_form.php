<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use frontend\models\BannerGallery;

/* @var $this yii\web\View */
/* @var $model frontend\models\Banner */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="banner-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'BANNER_GALLERY_ID')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(BannerGallery::find()->all(), 'ID', 'DESCRIPTION'),
        'options' => ['placeholder' => 'Выберите галарею ...'],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]); ?>

    <?= $form->field($model, 'TEXT')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'LINK_URL')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'FILE_URL')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'REC_STATUS')->textInput() ?>

    <?= $form->field($model, 'TARGET_ID')->textInput() ?>

    <?= $form->field($model, 'PORYADOK')->textInput() ?>

<!--    --><?//= $form->field($model, 'CREATED')->textInput() ?>

    <?= $form->field($model, 'CREATED_BY')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'UPDATED')->textInput() ?>

    <?= $form->field($model, 'UPDATED_BY')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
