<?php

use yii\helpers\Html;
use kartik\date\DatePicker;
use frontend\models\Page;

use kartik\grid\GridView;
//use yii\grid\GridView;
use yii\widgets\Pjax;

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

    <?= $this->render('_pjax-form',[
        'model' => $model,
    ]) ?>

    <?php
    \yii\bootstrap\Modal::begin([
        'header' => "<h4>Pages/Страницы</h4>",
        'id' => 'modal',
        'size' => 'modal-lg',
    ]);
    echo '<div id="modalContent"></div>';
    \yii\bootstrap\Modal::end();
    ?>

<!--    --><?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div>
        <?= Html::a(Yii::t('app', 'Добавить новую страницу'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Очистить все фильтры'), ['index'], ['class' => 'btn btn-default']) ?>
    </div>

    <?php Pjax::begin(['id' => 'pages', 'timeout' => false, 'enablePushState' => false]);?>
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
                'attribute' => 'created_by',
                'class' => 'kartik\grid\EditableColumn',
                //'format' => 'raw',
                'editableOptions' => [
                    'header' => 'Created_by',
                    //'inputType' => kartik\editable\Editable::INPUT_TEXT,
                ],

            ],
            'ip_address',
            [
                'attribute' => 'title',
                'class' => '\kartik\grid\DataColumn',
                'pageSummary' => true,
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
//                'buttons' => [
//                    'delete' => function ($url, $model) {
//                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
//                            'title' =>'Удалить',
//                            //'data-confirm'=>"Хотите удалить?",
//                            'data-pjax' => 1
//                        ]);
//                    },
//                ],
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
            //'content:ntext',
            //'description',
            //'updated',
            //'updated_by',
            [
                'attribute' => 'rec_status',
                'value' => 'recStatusName',
                'filter' => Page::getRecStatusList(),
            ],
        ],
    ]); ?>
    <?php Pjax::end();?>

</div>
