<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model frontend\models\FileStorage */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="file-storage-form">
<?php print_r(\frontend\models\FileStorage::find()->andWhere(['is_image' => 1])->orderBy('sort'));?>

    <?php $form = ActiveForm::begin(['options' => ['encrypt' => 'multipart/form-data']]); ?>
<!--    --><?//= $form->field($model, 'file_url')->textInput() ?>

<!--    --><?//= $form->field($model, 'attachment')->fileInput(['id' => 'input-id', 'accept' => 'image/*']) ?>

<!---->
<!--    --><?//= $form->field($model, 'created_by')->textInput(['maxlength' => true]) ?>
<!---->
<!--    --><?//= $form->field($model, 'updated')->textInput() ?>
<!---->
<!--    --><?//= $form->field($model, 'updated_by')->textInput(['maxlength' => true]) ?>
<!---->
<!--    --><?//= $form->field($model, 'rec_status')->textInput() ?>
<!---->
<!--    --><?//= $form->field($model, 'site_lang_id')->textInput() ?>
<!---->
<!--    --><?//= $form->field($model, 'ftype')->textInput(['maxlength' => true]) ?>
<!---->
<!--    --><?//= $form->field($model, 'fsize')->textInput() ?>
<!---->
<!--    --><?//= $form->field($model, 'is_image')->textInput() ?>
<!---->
<!--    --><?//= $form->field($model, 'origin')->textInput(['maxlength' => true]) ?>
<!---->
<!--    --><?//= $form->field($model, 'tip_dostupa_id')->textInput() ?>
<!--    <b>1</b><br>-->
<!---->
<!--    <div class="file-loading">-->
<!--        <input id="input-pr-rev" name="input-pr-rev[]" type="file" multiple>-->
<!--    </div>-->
<!---->
<!--    <b>2</b><br>-->
<!---->
    <?= FileInput::widget([
        'name' => 'FileStorage[attachment]',
//        'name' => 'attachment[]',
        'id' => 'input-id',
        'options'=>[
            'accept' => 'image/*',
            'multiple'=>true,
            'showCancel' => true,
        ],
        'pluginOptions' => [
            'uploadUrl' => Url::to(['/file-storage/upload']),
            'uploadExtraData' => [
                'FileStorage[is_image]' => 1,
//                'FileStorage[file_url]' => $model->file_url,
            ],
            'deleteUrl' => Url::to(['/file-storage/delete-image', 'key' => $model->id]),
//            'initialPreview' => $model->imagesLinks,
            'initialPreviewAsData' => true,
            'initialPreviewConfig' => $model->imagesLinksData,
            'overwriteInitial' => false,
            'maxFileCount' => 5,
            'allowedFileExtensions' => ['jpg', 'jpeg', 'png', 'bmp', 'gif'],
        ],
        'pluginEvents' => [
            'filesorted' => new \yii\web\JsExpression('function(event, params)
                {$.post("'.Url::toRoute(["/file-storage/sort-image","id"=>$model->id]).'",{sort: params});
            }')
        ],
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script>

    $("#input-pr-rev").fileinput({
        uploadUrl: '',
        theme: 'explorer-fas',
        uploadAsync: true,
        reversePreviewOrder: true,
        initialPreviewAsData: false,
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

<!--<script>-->
<!--    $('document').on('ready', function() {-->
<!--        $("#input-id").fileinput({-->
<!--            uploadUrl: '/file-storage/upload',-->
<!--            enableResumableUpload: false,-->
<!--            resumableUploadOptions: {-->
<!--                // uncomment below if you wish to test the file for previous partial uploaded chunks-->
<!--                // to the server and resume uploads from that point afterwards-->
<!--                // testUrl: "http://localhost/test-upload.php"-->
<!--            },-->
<!--            uploadExtraData: {-->
<!--                'uploadToken': '123SOME-TOKEN321', // for access control / security-->
<!--            },-->
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