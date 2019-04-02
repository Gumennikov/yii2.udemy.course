<?php
/**
 * Created by PhpStorm.
 * User: gumennikov
 * Date: 29.03.2019
 * Time: 14:24
 */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('app', 'Signup');

?>

<h1><?= Html::encode($this->title) ?></h1>

<p><?= Yii::t('app', 'Please, fill the form.')?></p>

<div class="row">
    <div class="col-lg-5">
        <?php $registerForm = ActiveForm::begin([
            'id' => 'register-form',
            'layout' => 'horizontal',
            'fieldConfig' => [
                'template' => "{label}\n<div class=\"col-3\">{input}</div>\n<div class=\"col-8\">{error}</div>",
                'labelOptions' => ['class' => 'col-lg-1 control-label'],
                ],
        ]); ?>
        <!--Включение сообщений об ошибках в модели $newUser-->
        <?= $registerForm->errorSummary($newUser) ?>
        <?= $registerForm->field($newUser, 'username')->textInput(['autofocus' => true]) ?>
        <?= $registerForm->field($newUser, 'email')->textInput() ?>
        <!--Значение 'value' => '' для password устанавливается,
        чтобы при перезагрузке формы пароль не сохранялся в форме-->
        <?= $registerForm->field($newUser, 'password')->passwordInput(['value' => '']) ?>

        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton(Yii::t('app', 'Signup'), ['class' => 'btn btn-primary', 'name' => 'register-button']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
