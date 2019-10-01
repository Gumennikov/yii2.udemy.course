<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;

/* @var $this yii\web\View */
/* @var $model app\models\Comment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="comment-form">

    <h1>Форма отправки нового комментария</h1>

    <?php $form = ActiveForm::begin([
//        'enableAjaxValidation' => false,
//        'enableClientValidation' => false,
//        'validateOnSubmit' => false,
    ]); ?>

    <!--    --><?//= $form->field($model, 'entity')->textInput(['maxlength' => true]) ?>

    <!--    --><?//= $form->field($model, 'entityId')->textInput() ?>

    <?= $form->field($model, 'createdBy')->textInput()?>

    <?= $form->field($model, 'email')->textInput() ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <!--    --><?//= $form->field($model, 'parentId')->textInput() ?>
    <!---->
    <!--    --><?//= $form->field($model, 'level')->textInput() ?>

    <!--    --><?//= $form->field($model, 'updatedBy')->textInput() ?>
    <!---->
    <!--    --><?//= $form->field($model, 'relatedTo')->textInput(['maxlength' => true]) ?>
    <!---->
    <!--    --><?//= $form->field($model, 'url')->textarea(['rows' => 6]) ?>
    <!---->
    <!--    --><?//= $form->field($model, 'status')->textInput() ?>
    <!---->
    <!--    --><?//= $form->field($model, 'createdAt')->textInput() ?>
    <!---->
    <!--    --><?//= $form->field($model, 'updatedAt')->textInput() ?>

    <!--    --><?//= $form->field($model, 'verifyCode')->widget(Captcha::className()) ?>

        <?= $form->field($model, 'reCaptcha', ['enableAjaxValidation' => false])->widget(
            \himiklab\yii2\recaptcha\ReCaptcha3::className(), [
                'name' => 'reCaptcha',
                'action' => 'view',
        //'widgetOptions' => ['class' => 'recaptcha-login']
        ]
        )->label(false); ?>

    <?/*= $form->field($model, 'reCaptcha', ['enableAjaxValidation' => false])->widget(
        \himiklab\yii2\recaptcha\ReCaptcha2::className()
    ) */?>

    <?/*= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
        //'captchaAction' => '/index/captcha',
        'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
    ]) */?>

    <div class="form-group" align="right">
        <?= Html::submitButton('Отправить комментарий', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>