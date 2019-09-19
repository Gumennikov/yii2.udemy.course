<?php
/* $model: apps\content\forms\UploadImageForm */

use yii\widgets\ActiveForm;
use yii\bootstrap\Alert;
use yii\helpers\Html;

use kartik\file\FileInput;
?>
<?php
$msgFlash = Yii::$app->session->getFlash('flashMessage');

if (isset($msgFlash)) {
    echo Alert::widget([
        'options' => ['class' => 'alert-info'],
        'body' => $msgFlash,
    ]);
}
?>
<div class = "row">
    <div class = "col-lg-5">
        <?php $form = ActiveForm::begin(['id' => 'upload-pucture-form',
            'options' => ['enctype' => 'multipart/form-data']]); ?>

        <?= $form->field($model, 'fileUpload')->widget(FileInput::class, [
            'options' => ['accept' => 'image/*'],
            'pluginOptions' => [
                'showPreview' => true,
                'showCaption' => true,
                'showRemove' => true,
                'showUpload' => false,
                //'allowedFileExtensions'=>['jpg', 'jpeg', 'png', 'bmp', 'gif'],
            ]
        ]); ?>

        <div class = "form-group">
            <?php echo Html::submitButton(Yii::t('app','Загрузить'), ['class' => 'btn btn-primary',
                'name' => 'upload-form-button']); ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
