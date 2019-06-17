<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\BannerSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="banner-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'BANNER_GALLERY_ID') ?>

    <?= $form->field($model, 'TEXT') ?>

    <?= $form->field($model, 'LINK_URL') ?>

    <?= $form->field($model, 'FILE_URL') ?>

    <?php // echo $form->field($model, 'REC_STATUS') ?>

    <?php // echo $form->field($model, 'TARGET_ID') ?>

    <?php // echo $form->field($model, 'PORYADOK') ?>

    <?php // echo $form->field($model, 'CREATED') ?>

    <?php // echo $form->field($model, 'CREATED_BY') ?>

    <?php // echo $form->field($model, 'UPDATED') ?>

    <?php // echo $form->field($model, 'UPDATED_BY') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
