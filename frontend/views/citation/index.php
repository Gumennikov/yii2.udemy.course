<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use kartik\widgets\Select2;
//use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CitationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Citation Records';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="citation-record-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Citation Record', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ID',
            //'AUTHOR_NAME',
            [
                'attribute' => 'AUTHOR_NAME',
                'enableSorting' => true,
                'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'AUTHOR_NAME',
                    'name' => Html::getInputName($searchModel, 'AUTHOR_NAME'),
                    'value' => $searchModel->AUTHOR_NAME,
                    'data' =>$dataFilter['properties'],
                ]),
                'value' => function($model) {
                    return $model->AUTHOR_NAME;
                },
            ],
            'IZDANIE',
            'TEXT',
            'CREATED',
            //'CREATED_BY',
            //'UPDATED',
            //'UPDATED_BY',
            //'CITATION_STATUS',
            //'REC_STATUS',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
