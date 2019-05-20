<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use frontend\models\SiteLang;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use frontend\models\Language;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;

/* @var $this yii\web\View */
/* @var $model frontend\models\Page */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="page-form">

    <?php $form = ActiveForm::begin(); ?>

<!--    --><?//= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'site_lang_id')->textInput() ?>

<!--    --><?//= $form->field($model, 'site_lang_id')->dropDownList(
//        ArrayHelper::map(SiteLang::find()->all(), 'id', 'language_id')
//    ) ?>

<!--    --><?//= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'created')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'updated')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->widget(CKEditor::class, [
        // С возможностью вставлять картинки с удаленных серверов
        'editorOptions' => [
            // разработанны стандартные настройки basic, standard, full
            // данную возможность не обязательно использовать
            'preset' => 'full',
            'inline' => false, //по умолчанию false
            'language' => 'ru',
            'extraPlugins' => 'preview', //подключаем плагин для предварительного просмотра
            'allowedContent' => true,
            'height' => 'auto'
        ],

        /*'editorOptions' => ElFinder::ckeditorOptions('elfinder', [
            // разработанны стандартные настройки basic, standard, full
            // данную возможность не обязательно использовать
            'preset' => 'full',
            'language' => 'ru',
            'extraPlugins' => 'preview', //подключаем плагин для предварительного просмотра
        ]),
        */

    ]) ?>

    <!--    --><?//= $form->field($model, 'rec_status')->textInput() ?>

    <!--    --><?php //echo $form->field($model, 'tags_array')->widget(Select2::classname(), [
    //    'data' => \yii\helpers\ArrayHelper::map( \frontend\models\Tag::find()->all(), 'id', 'tag'),
    //    'language' => 'ru',
    //    'options' => [
    //        'placeholder' => 'Выберите tag ...',
    //        'multiple' => true,
    //    ],
    //    'pluginOptions' => [
    //        'allowClear' => true,
    //        'tags' => true,
    //        'maximumInputLength' => 10,
    //    ],
    //    ]); ?>

    <div class="form-group" align="right">
        <?= Html::submitButton(Yii::t('app', 'Сохранить и просмотреть'), ['class' => 'btn btn-success']) ?>
<!--        --><?//= Html::a(Yii::t('app','Сохранить и просмотреть'),
//            ['page/view?id='.$model->id],
//            ['class' => 'btn btn-success', 'data' => ['method' => 'post']]
//        ) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
