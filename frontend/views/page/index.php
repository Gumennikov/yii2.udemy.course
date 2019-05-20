<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\date\DatePicker;
use frontend\models\Page;

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

    <h1><?= Html::encode($this->title) ?></h1>

<!--    --><?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Добавить новую страницу'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Очистить все фильтры'), ['index'], ['class' => 'btn btn-default']) ?>
    </p>

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
            //'site_lang_id',
            //'content:ntext',
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
            //'updated',
            //'updated_by',
            //'title',
            //'description',
            [
                'attribute' => 'rec_status',
                'filter' => Page::getRecStatusList(),
                'value' => 'recStatusName',
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
            ],
        ],
    ]); ?>


</div>
