<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BannerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Banners';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="banner-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Banner', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ID',
            'BANNER_GALLERY_ID',
            'TEXT',
            'LINK_URL:url',
            'FILE_URL:url',
            //'REC_STATUS',
            //'TARGET_ID',
            //'PORYADOK',
            //'CREATED',
            //'CREATED_BY',
            //'UPDATED',
            //'UPDATED_BY',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
