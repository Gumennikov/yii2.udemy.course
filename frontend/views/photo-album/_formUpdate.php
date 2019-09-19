<?php
use yii\bootstrap\Alert;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

use kartik\file\FileInput;

$msgFlash = Yii::$app->session->getFlash('flashMessage');

if (isset($msgFlash)) {
    echo Alert::widget([
        'options' => ['class' => 'alert-info'],
        'body' => $msgFlash,
    ]);
}
?>

<div class="photo-album-form">

    <!-- Форма для изменения названия фотоальбома -->
    <?php $form = ActiveForm::begin(); ?>

    <!--    --><?//= $form->field($model, 'id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <!--    --><?//= $form->field($model, 'site_lang_id')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Сохранить'), [
                'class' => 'btn btn-success',
                'name' => 'btnSave',
                'value' => 'title',
        ]); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<div>
    <?php
        // $images двумерный массив с атрибутами изображений из из фотоальбома
        if (count($images) > 0) {
            $csrfParam = Yii::$app->getRequest()->csrfParam;
            $csrfToken = Yii::$app->request->getCsrfToken();

            $urlOrder = Url::to(['/content/photo-album/change-order']);

            $imageURLs = [];
            $deleteURLs = [];
            for ($i=0; $i < count($images); $i++) {
                // Массив с url на изображения из альбома
                $imageURLs[$i] = $images[$i]['url'];

                // Массив с url для удаления изображения из альбома
                // (будет присваиваться  параметру initialPreviewConfig)
                $deleteURLs[$i]['url'] = Url::toRoute([
                    '/content/photo-album/delete-image',
                    // id'шник фотоальбома
                    'albumId' => $model->id,
                    // id'шник записи из таблицы PhotoAlbumFile
                    'albumFileId' => $images[$i]['id'],
                ]);
            }

            // Показать изображения из фотоальбома.
            // С возможностью удаления, и изменения порядка
            echo FileInput::widget([
                'id' => 'album-preview',
                'name' => 'preview',
                'options' => [
                    'accept'=>'image/*',
                    'multiple' => true
                ],
                'pluginOptions'=>[
                    //'deleteUrl' => Url::toRoute(['/content/photo-album/delete-image', 'albumId' => $model->id]),

                    'initialPreview' => $imageURLs,
                    'initialPreviewConfig' => $model->fileLinksData,
//                    'initialPreviewConfig' => $deleteURLs,

                    'initialPreviewAsData'=> true,
                    'overwriteInitial' => false,
                    'showPreview' => true,
                    'showCaption' => false,
                    'showRemove' => false,
                    'showUpload' => false,

                    // Убрать кнопку "Выбрать файл"
                    'browseClass' => '',
                    'browseIcon' => '',
                    'browseLabel' => '',

                    //'allowedFileExtensions'=> ['jpeg', 'jpg', 'gif', 'png'],
                ],

                'pluginEvents' => [
                    // Обработчик события: изменение порядка картинок в фотоальбоме
                    'filesorted' => "function (event, params) {
                        //console.log('File sorted ', params.previewId, params.oldIndex, params.newIndex, params.stack);
                        sendData = {
                            '{$csrfParam}': '{$csrfToken}',
                            param: params,
                            albumId: '{$model->id}',
                        };
                        //console.log(sendData);
                        
                        js$.ajax({
                            url: '{$urlOrder}',
                            type: 'POST',
                            
                            data: sendData,
                            dataType: 'json',
                            
                            success: function (data, textStatus, xhr) {
                                var jsonData = JSON.parse(xhr.responseText);
                                
                                if (jsonData.success != true) {
                                    // При отладке выводим описание ошибки
                                    //myJs.showErrorMessage(jsonData.errorMsg);
                                    //return;
                                    
                                    // Закомментировать при отладке
                                    alert('Ошибка при обращении к серверу'); 
                                    window.location.reload();
                                }
                            },
                            // Функция, вызываемая, если запрос завершится с ошибкой
                            error: function(xhr, textStatus, errorThrown) {
                                // Закомментировать при отладке
                                alert('Ошибка при обращении к серверу'); 
                                window.location.reload();
                            }
                        });
                    }",

                    // Подтверждение удаления картинки из фотоальбома
                    'filebeforedelete' => "function(event, key, params) {
                        //console.log('Before delete');
                        return !window.confirm('Удалить файл из фотоальбома?');
                    }",
                ],
            ]);  // END: echo FileInput::widget([
        }  // END: if (count($images) > 0) {
    ?>
</div>

<div>
    <br/>
    <!-- Форма для добавления картинки в фотоальбом -->
    <?php $uploadForm = ActiveForm::begin(['id' => 'upload-pucture-form',
        'options' => ['enctype' => 'multipart/form-data']]); ?>

    <?php echo $uploadForm->field($uploadImageModel, 'fileUpload')->widget(FileInput::class, [
        'options' => ['accept' => 'image/*'],
        'pluginOptions' => [
            'showPreview' => true,
            'showCaption' => true,
            'showRemove' => true,
            'showUpload' => false,
            //'allowedFileExtensions'=>['jpg', 'jpeg', 'png', 'gif'],
        ]
    ]); ?>

    <div class = "form-group">
        <?= Html::submitButton(Yii::t('app','Загрузить'), [
            'class' => 'btn btn-primary',
            'name' => 'btnSave',
            'value' => 'picture',
        ]); ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
