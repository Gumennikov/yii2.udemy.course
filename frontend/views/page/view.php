<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Breadcrumbs;
use yii\bootstrap\Alert;
use yii\web\BadRequestHttpException;
use yii\widgets\ListView;
use app\models\Comment;

/* @var $this yii\web\View */
/* @var $model frontend\models\Page */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Pages', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $parents;
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<?php /*$lang = \frontend\models\Page::find()->one();
var_dump($lang->languageName);
*/?>
<!--<br>
<?php /*var_dump(Yii::$app->request->get('id'));*/?>
<br>
<?php
/*$rawCount = Yii::$app->db->createCommand('SELECT COUNT(id) FROM page WHERE parent_id = ' . $model->id)->queryScalar();
$rawCount = (int)$rawCount;
var_dump($rawCount);*/?>
<br><br>-->

<?php
/*if ($rawCount > 0) {
    print_r('Массив дочерних страниц:' . '<br>');
    $params = [':parent_id' => $model->id];

    $children = Yii::$app->db->createCommand('SELECT title FROM page WHERE parent_id=:parent_id')
        ->bindValues($params)
        ->queryAll();

    foreach ($children as $child => $title) {
        print_r($title);
        print_r('<br>');
//    var_dump($child);
    };
}
*/?>
<br>
<p><b>Массив Родительских элементов:</b></p>
<br><br>
<?php
//$hasParents = Yii::$app->db->createCommand('SELECT COUNT(id) FROM page WHERE id = ' . $model->parent_id)->queryScalar();

if ($model->id != null) {
    $parentId = $model->id;
    $parents = [];
    $model->getParents($parentId, $parents);

    $links = [];
    //Из БД массив $parents[] приходит, начиная с последнего элемента (Третья страница/Вторая страница/Первая страница)
    //При выводе проходим массив с конца
    for ($i=count($parents)-2; $i>=1; $i--) {
        $links[$i]['label'] = $parents[$i]['title'];
        $links[$i]['url'] = $parents[$i]['alias'];
    }
    array_push($links, $parents[0]['title']);
//    var_dump($links);
    echo Breadcrumbs::widget([
        'itemTemplate' => "<li>{link}</li>\n", // template for all links
        'links' => $links,
    ]);
//    var_dump($parents);

//    foreach (array_reverse($parents) as $parent => $key) {
//        foreach ($key as $item) {
//            print_r('<pre>'.$key.': '.$item.'</pre>');
//        }
//    }
} else { print_r('Родительских элементов нет'); }
?>
<br><br>
<?php
//echo print_r('$this->params[\'breadcrumbs\']: ');
//echo var_dump($this->params['breadcrumbs']);
//?>
<br>

<div>
    <?php
    $msgFlash = Yii::$app->session->getFlash('checkComment');

    if (isset($msgFlash)) {
        echo Alert::widget([
            'options' => ['class' => 'alert-success'],
            'body' => $msgFlash,
        ]);
    }
    ?>
</div>

<div>
    <?php
    $msgFlash = Yii::$app->session->getFlash('cantSaveComment');

    if (isset($msgFlash)) {
        echo Alert::widget([
            'options' => ['class' => 'alert-danger'],
            'body' => $msgFlash,
        ]);
    }
    ?>
</div>

<?php

$links = [];
//$i=;
//var_dump($parents);
//Из БД массив $parents приходит, начиная с последнего элемента (Третья страница/Вторая страница/Первая страница)
//При выводе проходим массив с конца
for ($i=count($parents)-2; $i>=1; $i--) {
    $links[$i]['label'] = $parents[$i]['title'];
    $links[$i]['url'] = $parents[$i]['alias'];
}

//foreach (array_reverse($parents) as $item) {
//    $links[$i]['label'] = $item['title'];
//    $links[$i]['url'] = $item['alias'];
//    $i++;
//}
//array_push($links, $parents[0]['title']);
//var_dump($links);
//echo Breadcrumbs::widget([
//    'itemTemplate' => "<li>{link}</li>\n", // template for all links
//    'links' => $links,
////    'links' => [
////        [
////            'label' => 'Post Category',
////            'url' => ['post-category/view', 'id' => 10],
////            'template' => "<li><b>{link}</b></li>\n", // template for this link only
////        ],
////        ['label' => 'Sample Post', 'url' => ['post/edit', 'id' => 1]],
////        'Edit',
////    ],
//]);
?>
<br><br>
<div class="page-view">

<!--    <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->
<!---->
<!--    <p>-->
<!--        --><?//= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
<!--        --><?//= Html::a('Delete', ['delete', 'id' => $model->id], [
//            'class' => 'btn btn-danger',
//            'data' => [
//                'confirm' => 'Are you sure you want to delete this item?',
//                'method' => 'post',
//            ],
//        ]) ?>
<!--    </p>-->
<!---->
<!--    --><?//= DetailView::widget([
//        'model' => $model,
//        'attributes' => [
//            'id',
//            'parent_id',
//            'site_lang_id',
//            'title',
//            'created',
//            'created_by',
//            'ip_address',
//            'updated',
//            'rec_status',
//            'updated_by',
//            //'description',
//            //'content:raw',
//        ],
//    ]) ?>
<!---->
<!--    <div><h3><strong>--><?//= $model->title; ?><!--</strong></h3></div>-->
<!---->
<!--    <div>--><?//= $model->content; ?><!--</div>-->

    <!--    --><?php //var_dump($newComment); ?>
    <?php if (Yii::$app->user->isGuest) {
        echo $this->render('newComment', ['model' => $newComment]);
    }; ?>

    <?/*= GridView::widget([
        'dataProvider' => Comment::all($model->id),
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'entityId',
            'content:ntext',
            'createdBy',
            'createdAt:datetime',
            'status',
            //'entity',
            //'parentId',
            //'level',
            //'updatedBy',
            //'relatedTo',
            //'url:ntext',
            //'updatedAt',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); */?>

    <?= ListView::widget([
        'dataProvider' => Comment::all($model->id),
        'itemView' => '_viewComment',
    ]);?>

</div>
