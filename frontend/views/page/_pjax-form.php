<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use mihaildev\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model \frontend\models\Page */
/* @var $form yii\widgets\ActiveForm */
?>

<?php
$this->registerJs(
    '$("document").ready(function(){
            $("#new_page").on("pjax:end", function() {
            $.pjax.reload({container:"#pages"});  //Reload GridView
        });
    });'
);
?>

<div class="pages-form">
    <?php Pjax::begin(['id' => 'new_page']) ?>
    <?php $form = ActiveForm::begin(['options' => ['data-pjax' => true]]); ?>

    <?= $form->field($model, 'title')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(
            $model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'),
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <?php Pjax::end(); ?>

</div>