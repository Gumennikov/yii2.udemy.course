<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use frontend\models\PageTree;
use kartik\tree\TreeView;
use kartik\tree\TreeViewInput;
use kartik\icons\FontAwesomeAsset;
use kartik\tree\Module;
FontAwesomeAsset::register($this);
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PageTreeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Page Trees';
$this->params['breadcrumbs'][] = $this->title;
?>

<pre><?php print_r($model->errors); ?></pre>

<div class="page-tree-index">
    <?php echo TreeView::widget([
        // single query fetch to render the tree
        // use the Product model you have in the previous step
        'query' => PageTree::find()->addOrderBy('root, lft'),
        'headingOptions' => ['label' => 'Categories'],
        'fontAwesome' => true,     // optional
        'isAdmin' => true,         // optional (toggle to enable admin mode)
        'displayValue' => 1,        // initial display value
        'softDelete' => true,       // defaults to true
        'showTooltips' => false,
        'nodeAddlViews' => [
        Module::VIEW_PART_5 => '@frontend/views/page-tree/page-view-button'
        ],
        'cacheSettings' => [
            'enableCache' => false   // defaults to true
        ]
    ]);
    ?>
</div>

<!--<div class="page-tree-input-index">-->
<!--    --><?php //echo TreeViewInput::widget([
//        // single query fetch to render the tree
//        // use the Product model you have in the previous step
//        'query' => PageTree::find()->addOrderBy('root, lft'),
//        'headingOptions'=>['label'=>'Categories'],
//        'name' => 'kv-product', // input name
//        'value' => '1,2,3',     // values selected (comma separated for multiple select)
//        'asDropdown' => true,   // will render the tree input widget as a dropdown.
//        'multiple' => true,     // set to false if you do not need multiple selection
//        'fontAwesome' => true,  // render font awesome icons
//        'rootOptions' => [
//            'label'=>'<i class="fa fa-tree"></i>',  // custom root label
//            'class'=>'text-success'
//        ],
//        //'options'=>['disabled' => true],
//    ]);
//    ?>
<!--</div>-->

<!--<div class="page-tree-index">-->
<!---->
<!--    <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->
<!---->
<!--    <pre>--><?php //print_r($arrPage); ?><!--</pre>-->
<!---->
<!--    <p>-->
<!--        --><?//= Html::a('Create Page Tree', ['create'], ['class' => 'btn btn-success']) ?>
<!--    </p>-->
<!---->
<!-- --><?php ////Pjax::begin(); ?>
<!--    --><?php //// echo $this->render('_search', ['model' => $searchModel]); ?>
<!---->
<!--    --><?//= GridView::widget([
//        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
//        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
//            ['class' => 'yii\grid\ActionColumn'],
//
//            'id',
//            'link_id',
////            [
////                'attribute' => 'link_id',
////                'value' => '',
////                'filter' => $arrPage,
////            ],
//            'root',
//            'lft',
//            'rgt',
//            'lvl',
//            //'name',
//            //'icon',
//            //'icon_type',
//            //'active',
//            //'selected',
//            //'disabled',
//            //'readonly',
//            //'visible',
//            //'collapsed',
//            //'movable_u',
//            //'movable_d',
//            //'movable_l',
//            //'movable_r',
//            //'removable',
//            //'removable_all',
//
//        ],
//    ]); ?>
<!---->
<!-- --><?php ////Pjax::end(); ?>
<!---->
<!--</div>-->
