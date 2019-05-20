<?php

use yii\helpers\Html;
use kartik\grid\GridView;


/* @var $this yii\web\View */
/* @var $searchModel common\modules\banner\models\BannerGallerySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Banner Galleries';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="banner-gallery-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Banner Gallery', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

<!--    --><?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ID',
            'DESCRIPTION',
            'WIDTH',
            'HEIGHT',
            'CREATED',
            //'CREATED_BY',
            //'UPDATED',
            //'UPDATED_BY',
            //'REC_STATUS',

            ['class' => 'yii\grid\ActionColumn'],
        ],
        'responsive' => true,
        'hover' => true,
    ]); ?>


</div>
