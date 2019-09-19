<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PhotoAlbumSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="photo-album-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'TITLE') ?>

    <?= $form->field($model, 'CREATED') ?>

    <?= $form->field($model, 'CREATED_BY') ?>

    <?= $form->field($model, 'UPDATED') ?>

    <?php // echo $form->field($model, 'UPDATED_BY') ?>

    <?php // echo $form->field($model, 'REC_STATUS') ?>

    <?php // echo $form->field($model, 'SITE_LANG_ID') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
