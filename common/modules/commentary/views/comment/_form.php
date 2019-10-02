<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Comment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="comment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'entity')->textInput(['maxlength' => true, 'readonly' => true]) ?>

    <?= $form->field($model, 'entityId')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6, 'readonly' => true] ) ?>

    <?= $form->field($model, 'parentId')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'level')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'createdBy')->textInput(['maxlength' => true, 'readonly' => true]) ?>

    <?= $form->field($model, 'updatedBy')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'relatedTo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'url')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'createdAt')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'updatedAt')->textInput(['readonly' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
