<?php

use yii\helpers\Html;
use kartik\date\DatePicker;
use frontend\models\Page;

use kartik\grid\GridView;
//use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pages';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-index">

<!--    Список для выбора языков-->
<!--    <p align="right">-->
<!--        --><?//= $lang = ; ?>
<!--    </p>-->
    <div><pre></pre></div>

    <h1><?= Html::encode($this->title) ?></h1>

<!--    --><?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Добавить новую страницу'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Очистить все фильтры'), ['index'], ['class' => 'btn btn-default']) ?>
    </p>

    <?= GridView::widget([
        'moduleId' => 'gridviewKrajee',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'responsive'=>true,
        'hover'=>true,

        'columns' => [
            [
                'attribute' => 'id',
                'value' => function ($model) {
                    return Html::a($model->id,['view', 'id' => $model->id]);
                },
                'format' => 'raw',
            ],
            [
                'attribute' => 'title',
                'class' => '\kartik\grid\DataColumn',
                'pageSummary' => true,
            ],
            'parent_id',
            'parentName',
            'pageNameAndId',
            [
                'attribute' => 'languageName',
                'label' => 'Язык страницы',
//                'filter' => Page::getLanguage(),
            ],
            [
                'attribute' => 'created',
                'filter' => DatePicker::widget([
                    'model' => $searchModel,
                    'value' => $searchModel->created,
                    'attribute' => 'created',
                    'type' => DatePicker::TYPE_COMPONENT_APPEND,
                    'pluginOptions' => [
                        'format' => 'dd.mm.yyyy',
                        'todayHighlight' => true,
                        'autoclose'=>true,
                    ],
                ])
            ],
            'created_by',
            //'content:ntext',
            //'description',
            //'updated',
            //'updated_by',
            [
                'attribute' => 'rec_status',
                'value' => 'recStatusName',
                'filter' => Page::getRecStatusList(),
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
            ],
        ],
    ]); ?>


</div>
