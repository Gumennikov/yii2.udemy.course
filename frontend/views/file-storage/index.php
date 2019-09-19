<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FileStorageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'File Storages');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="file-storage-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create File Storage'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'id',
                'value' => function ($model) {
                    return Html::a($model->id,['view', 'id' => $model->id]);
                },
                'format' => 'raw',
            ],
            'title',
            [
                'attribute' => 'file_url',
                'value' => function($model) {return 'http://storage.portal.tpu.localhost/' . $model->file_url;},
            ],
            [
                'label' => 'Изображение',
                'format' => 'raw',
                'value' => function($model) {return $model->getImageUrl();},
            ],
            'updated',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}',
            ],
        ],
    ]); ?>


</div>
