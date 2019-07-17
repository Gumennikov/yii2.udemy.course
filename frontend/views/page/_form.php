<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use frontend\models\SiteLang;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use frontend\models\Language;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
use frontend\models\Tag;
use yii\web\JsExpression;
use frontend\models\Page;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model frontend\models\Page */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="page-form">

    <?= $url = Url::to(['page-title']); ?>

    <?= $pageTitle = empty($model->page) ? '' : Page::findOne($model->page)->title;?>

    <?php $form = ActiveForm::begin(); ?>

<!--    --><?//= $form->field($model, 'id')->textInput() ?>

<!--    --><?//= $form->field($model, 'site_lang_id')->textInput() ?>

    <?= $form->field($model, 'site_lang_id')->dropDownList(
        ArrayHelper::map(SiteLang::find()->all(), 'id', 'language_id')
    ) ?>

<!--    --><?//= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

<!--    --><?//= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'title')->widget(Select2::class, [
        'initValueText' => $pageTitle, // set the initial display text
        'data' => ArrayHelper::map(Page::find()->all(),'id', 'title'),
        'options' => ['placeholder' => 'Выберите название страницы...'],
        'pluginOptions' => [
            'allowClear' => true,
            'minimumInputLength' => 2,
//            'language' => [
//                'errorLoading' => new JsExpression("function () { return 'Ожидание результатов...'; }"),
//            ],
//            'ajax' => [
//                'url' => $url,
//                'datatype' => 'json',
//                'data' => new JsExpression('function(params) { return {q:params.term}; }')
//            ],
//            'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
//            'templateResult' => new JsExpression('function(title) { return title.text; }'),
//            'templateSelection' => new JsExpression('function (title) { return title.text; }'),
        ],
    ]); ?>

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

        <?= $form->field($model, 'rec_status')->textInput() ?>

        <?php echo $form->field($model, 'tags_array')->widget(Select2::className(), [
        'data' => \frontend\models\PageTreeForm::getTargetList(),
        'language' => 'ru',
        'options' => [
            'placeholder' => 'Выберите tag ...',
            'multiple' => true,
        ],
        'pluginOptions' => [
            'allowClear' => true,
            'tags' => true,
            'maximumInputLength' => 10,
        ],
        ]); ?>

    <div class="form-group" align="right">
        <?= Html::submitButton(Yii::t('app', 'Сохранить и просмотреть'), ['class' => 'btn btn-success']) ?>
<!--        --><?//= Html::a(Yii::t('app','Сохранить и просмотреть'),
//            ['page/view?id='.$model->id],
//            ['class' => 'btn btn-success', 'data' => ['method' => 'post']]
//        ) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
