<?php
use yii\helpers\Html;
use yii\grid\GridView;

use kartik\date\DatePicker;
use globals\db\entity\kdf\system\RecordStatus;

use globals\help\DateHelper;
use apps\content\help\PhotoAlbumHelper;
?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
//        ['class' => 'yii\grid\SerialColumn'],
        [
            'attribute' => 'id',
            'value' => function ($model) {
                return Html::a($model->id,['view', 'id' => $model->id]);
            },
            'format' => 'raw',
        ],
        [
            'attribute' => 'title',
            'contentOptions' => ['style' => 'max-width: 500px; white-space: normal;'],
        ],
        [
            'attribute' => 'created',
            'value' => function ($model) {
                return DateHelper::formatToRusString($model->created);
            },
            'filter' => DatePicker::widget([
                'model' => $searchModel,
                'value' => $searchModel->created,
                'attribute' => 'created',
                'type' => DatePicker::TYPE_INPUT,
                'pluginOptions' => [
                    //'format' => 'dd.mm.yyyy',
                    'todayHighlight' => true
                ],
            ])
        ],
        [
            'attribute' => 'created_by',
            'value' => function($model) {
                return strtolower($model->created_by);
            },
        ],

        //'updated',
        //'updated_by',
        [
            'attribute' => 'rec_status',
            'value' => function($model) {
                $status = PhotoAlbumHelper::formatPhotoAlbumRecStatusAsString($model);
                return $status;
            },
            'filter' => [
                RecordStatus::DRAFT => Yii::t('app', 'Черновик'),
                RecordStatus::PUBLISHED => Yii::t('app', 'Опубликовано'),
                RecordStatus::ARCHIVE => Yii::t('app', 'В архиве'),
                RecordStatus::DELETED => Yii::t('app', 'Удалено'),
//                RecordStatus::CANCELLED_BY_ADMINISTRATOR => Yii::t('app', 'Отменено администратором'),
//                RecordStatus::CANCELLED_BY_USER => Yii::t('app', 'Отменено пользователем'),
//                RecordStatus::LOCKED => Yii::t('app', 'Заблокировано'),
//                RecordStatus::AWAITING_REVIEW => Yii::t('app', 'Ожидает проверки'),
            ],
        ],
        //'site_lang_id',

        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{update} {delete}',
        ],
    ],
]); ?>
