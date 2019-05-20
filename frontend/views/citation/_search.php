<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CitationSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="citation-record-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'AUTHOR_NAME') ?>

    <?= $form->field($model, 'IZDANIE') ?>

    <?= $form->field($model, 'TEXT') ?>

    <?= $form->field($model, 'CREATED') ?>

    <?php // echo $form->field($model, 'CREATED_BY') ?>

    <?php // echo $form->field($model, 'UPDATED') ?>

    <?php // echo $form->field($model, 'UPDATED_BY') ?>

    <?php // echo $form->field($model, 'CITATION_STATUS') ?>

    <?php // echo $form->field($model, 'REC_STATUS') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
