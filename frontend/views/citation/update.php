<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CitationRecord */

$this->title = 'Update Citation Record: ' . $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Citation Records', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="citation-record-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
