<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use frontend\models\SiteLang;
use frontend\models\FileStorage;
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

    <?php $form = ActiveForm::begin([
            'options' => ['encrypt' => 'multipart/form-data'],
    ]); ?>

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
            'preset' => 'basic',
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

<!-- ********* Загрузка картинки с помощью kartik file input *********   -->
<!--    <div>-->
<!--        <input id="input-100" name="input-100[]" type="file" accept="image/*" multiple>-->
<!--    </div>-->

<!--    <b>1</b><br>-->
<!---->
<!--    --><?//= $form->field($model, 'file')->widget(\kartik\file\FileInput::class, [
//        'options' => ['accept' => 'image/*'],
//        'pluginOptions' => [
//            'showPreview' => true,
//            'showCaption' => true,
//            'showRemove' => true,
//            'showUpload' => false,
//            'allowedFileExtensions'=>['jpg', 'jpeg', 'png', 'bmp', 'gif'],
//        ]
//    ]); ?>

    <b>1</b><br>

    <b>2</b><br>

    <?= \kartik\file\FileInput::widget([
        'name' => 'FileStorage[attachment]',
        'options'=>[
            'multiple'=>true
        ],
        'pluginOptions' => [
            'uploadUrl' => Url::to(['/file-storage/save-image']),
            'uploadExtraData' => [
                //Какой странице соответствует картинка
                'FileStorage[id]' => $model->id,
                'FileStorage[is_image]' => 1,
                'FileStorage[created_by]' => 'gumen',
                'FileStorage[updated_by]' => 'gumen',
                'FileStorage[rec_status]' => 11,
                'FileStorage[site_lang_id]' => 1,
            ],
            'maxFileCount' => 5,
            'allowedFileExtensions'=>['jpg', 'jpeg', 'png', 'bmp', 'gif'],
        ]
    ]); ?>

<!-- ********************************************************************** -->

    <?= $form->field($model, 'rec_status')->textInput() ?>

    <?= $form->field($model, 'tags_array')->widget(Select2::className(), [
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

<!--*********** Загрузка картинки с помощью https://github.com/vova07/yii2-imperavi-widget-->
<!--<b>3</b><br>-->
<!--<div>-->
<!--    --><?//= \kartik\widgets\FileInput::widget([
//        'name' => 'attachment[]',
//        'options'=>[
//            'multiple'=>true
//        ],
//        'pluginOptions' => [
//            'uploadUrl' => Url::to(['/file-storage/save-image']),
//            'uploadExtraData' => [
//                'ID' => $model->id,
//                'FTYPE' => $model->formName(),
//            ],
//            'maxFileCount' => 10
//        ]
//    ])?>
<!--</div>-->
<!--****************************************************************************************-->

<!--<script>-->
<!--    // Инициализация плагина с дополнительными опциаям with plugin options-->
<!--    $('document').on('ready', function() {-->
<!--        $("#input-id").fileinput({-->
<!--            uploadUrl: "http://localhost/file-upload.php",-->
<!--            enableResumableUpload: false,-->
<!--            resumableUploadOptions: {-->
<!--                // uncomment below if you wish to test the file for previous partial uploaded chunks-->
<!--                // to the server and resume uploads from that point afterwards-->
<!--                // testUrl: "http://localhost/test-upload.php"-->
<!--            },-->
<!--            // uploadExtraData: {-->
<!--            //     'uploadToken': 'SOME-TOKEN', // for access control / security-->
<!--            // },-->
<!--            maxFileCount: 5,-->
<!--            allowedFileTypes: ['image'],    // allow only images-->
<!--            showCancel: true,-->
<!--            initialPreviewAsData: true,-->
<!--            overwriteInitial: false,-->
<!--            // initialPreview: [],          // if you have previously uploaded preview files-->
<!--            // initialPreviewConfig: [],    // if you have previously uploaded preview files-->
<!--            theme: 'fas',-->
<!--            deleteUrl: "http://localhost/file-delete.php"-->
<!--        }).on('fileuploaded', function(event, previewId, index, fileId) {-->
<!--            console.log('File Uploaded', 'ID: ' + fileId + ', Thumb ID: ' + previewId);-->
<!--        }).on('fileuploaderror', function(event, data, msg) {-->
<!--            console.log('File Upload Error', 'ID: ' + data.fileId + ', Thumb ID: ' + data.previewId);-->
<!--        }).on('filebatchuploadcomplete', function(event, preview, config, tags, extraData) {-->
<!--            console.log('File Batch Uploaded', preview, config, tags, extraData);-->
<!--        });-->
<!--    });-->
<!--</script>-->



<!--*********************************************************************************************-->

<div class="file-loading">
    <input id="input-pr-rev" name="input-pr-rev[]" type="file" multiple>
</div>

<script>
        $("#input-pr-rev").fileinput({
            uploadUrl: '@images',
            theme: 'explorer-fas',
            uploadAsync: true,
            reversePreviewOrder: true,
            initialPreviewAsData: true,
            overwriteInitial: false,
            initialPreview: [
                "http://lorempixel.com/800/460/animals/3",
                "http://lorempixel.com/800/460/animals/4",
                "http://lorempixel.com/800/460/animals/5",
                "http://lorempixel.com/800/460/animals/6",
                "http://lorempixel.com/800/460/animals/7"
            ],
            initialPreviewConfig: [
                {caption: "Animals-3.jpg", size: 628782, width: "120px", url: "/site/file-delete", key: 3},
                {caption: "Animals-4.jpg", size: 628782, width: "120px", url: "/site/file-delete", key: 4},
                {caption: "Animals-5.jpg", size: 628782, width: "120px", url: "/site/file-delete", key: 5},
                {caption: "Animals-6.jpg", size: 628782, width: "120px", url: "/site/file-delete", key: 6},
                {caption: "Animals-7.jpg", size: 628782, width: "120px", url: "/site/file-delete", key: 7}
            ],
            allowedFileExtensions: ["jpg", "png", "gif"]
        }).on('filesorted', function(e, params) {
            console.log('Modified initial preview is ', $("#input-pr-rev").data('fileinput').initialPreview);
        });
</script>
<!--*********************************************************************************************-->
