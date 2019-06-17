<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\PageTree */

$this->title = 'Create Page Tree';
$this->params['breadcrumbs'][] = ['label' => 'Page Trees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-tree-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
