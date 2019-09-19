<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model globals\db\entity\content\search\FileStorageSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="file-storage-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'file_url') ?>

    <?= $form->field($model, 'created') ?>

    <?= $form->field($model, 'created_by') ?>

    <?= $form->field($model, 'updated') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'rec_status') ?>

    <?php // echo $form->field($model, 'site_lang_id') ?>

    <?php // echo $form->field($model, 'ftype') ?>

    <?php // echo $form->field($model, 'fsize') ?>

    <?php // echo $form->field($model, 'is_image') ?>

    <?php // echo $form->field($model, 'origin') ?>

    <?php // echo $form->field($model, 'tip_dostupa_id') ?>

    <?php // echo $form->field($model, 'hash') ?>

    <?php // echo $form->field($model, 'description') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
