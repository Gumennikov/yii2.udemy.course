<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model globals\db\entity\content\FileStorage */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="file-storage-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'file_url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rec_status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'site_lang_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_image')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hash')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
