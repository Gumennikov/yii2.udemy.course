<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PhotoAlbumSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Photo Albums');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="photo-album-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Photo Album'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ID',
            'TITLE',
            'CREATED',
            'CREATED_BY',
            'UPDATED',
            //'UPDATED_BY',
            //'REC_STATUS',
            //'SITE_LANG_ID',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
