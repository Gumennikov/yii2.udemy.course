<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $model frontend\models\Page */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Pages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<?php $lang = \frontend\models\Page::find()->one();
var_dump($lang->languageName);
?>
<br>
<?php var_dump(Yii::$app->request->get('id'));?>
<br>
<?php
$rawCount = Yii::$app->db->createCommand('SELECT COUNT(id) FROM page WHERE parent_id = ' . Yii::$app->request->get('id'))->queryScalar();
$rawCount = (int)$rawCount;
var_dump($rawCount);?>
<br><br>

<?php
if ($rawCount > 0) {
    print_r('Массив дочерних страниц:' . '<br>');
    $params = [':parent_id' => Yii::$app->request->get('id')];

    $children = Yii::$app->db->createCommand('SELECT title FROM page WHERE parent_id=:parent_id')
        ->bindValues($params)
        ->queryAll();

    foreach ($children as $child => $title) {
        print_r($title);
        print_r('<br>');
//    var_dump($child);
    };
}
?>
<br>
<p>Массив Родительских элементов: <?= var_dump($this->params['breadcrumbs']);?></p>
<?php
echo Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]);
?>
<br>
<?php
echo Breadcrumbs::widget([
    'itemTemplate' => "<li><i>{link}</i></li>\n", // template for all links
    'links' => [
        [
            'label' => 'Post Category',
            'url' => ['post-category/view', 'id' => 10],
            'template' => "<li><b>{link}</b></li>\n", // template for this link only
        ],
        ['label' => 'Sample Post', 'url' => ['post/edit', 'id' => 1]],
        'Edit',
    ],
]);
?>
<br><br>
<div class="page-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'site_lang_id',
            //'title',
            'description',
            'created',
            'created_by',
            'updated',
            'rec_status',
            'updated_by',
            //'content:raw',
        ],
    ]) ?>

    <div><h3><strong><?= $model->title ?></strong></h3></div>

    <div><?= $model->content ?></div>

</div>
