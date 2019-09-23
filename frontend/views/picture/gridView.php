<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel globals\db\entity\content\search\FileStorageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'File Storages';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="file-storage-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="form-group">
        <?php echo Html::a(Yii::t('app', 'Показать все файлы'),
            ['index', 'FileStorageSearch[is_image]' => 0],
            ['class' => 'btn btn-default', 'data-confirm' => 'Перейти?']) ?>

        <?php echo Html::a(Yii::t('app', 'Показать все изображения'),
            ['index', 'FileStorageSearch[is_image]' => 1],
            ['class' => 'btn btn-default']) ?>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'id',
                'value' => function ($model) {
                    return Html::a($model->id,['view', 'id' => $model->id]);
                },
                'format' => 'html',
            ],
            //'is_image',
            'title',
            [
                'attribute' => 'file_url',
                'value' => function($model) {return $model->file_url;},
                //'format' => 'raw',
                //'contentOptions' => ['style' => 'max-width: 500px; white-space: normal;'],
            ],
            [
                'label' => 'Изображение',
                'format' => 'html',
                'value' => function($model) {return $model->getImageUrl();},
            ],
            'updated',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{info} {update}',
                'buttons' => [
//                    'info' => function ($url, $model, $key) {
//                        $iconName = "info-sign";
//
//                        //Текст в title ссылки, что виден при наведении
//                        $title = \Yii::t('yii', 'info');
//
//                        $id = 'info-'.$key;
//                        $options = [
//                            'title' => $title,
//                            'aria-label' => $title,
//                            'data-pjax' => '0',
//                            'id' => $id
//                        ];
//
//                        $url = \yii\helpers\Url::current(['', 'id' => $key]);
//
//                        //Для стилизации используем библиотеку иконок
//                        $icon = Html::tag('span', '', ['class' => "glyphicon glyphicon-$iconName"]);
//
//                        //Обработка клика на кнопку
//                        $js = <<<JS
//            $("#{$id}").on("click",function(event){
//                    event.preventDefault();
//                    var myModal = $("#myModal");
//                    var modalBody = myModal.find('.modal-body');
//                    var modalTitle = myModal.find('.modal-header');
//
//                    modalTitle.find('h2').html('Информация.');
//                    modalBody.html('Тут будет информация.');
//
//                    myModal.modal("show");
//                }
//            );
//JS;
//
//
//                        //Регистрируем скрипты
//                        $this->registerJs($js, \yii\web\View::POS_READY, $id);
//
//                        return Html::a($icon, $url, $options);
//                    },
                ],
            ],
        ],
    ]); ?>
</div>
