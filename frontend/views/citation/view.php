<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\CitationRecord */

$this->title = $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Citation Records', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="citation-record-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->ID], [
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
            'ID',
            'AUTHOR_NAME',
            'IZDANIE',
            'TEXT',
            'CREATED',
            'CREATED_BY',
            'UPDATED',
            'UPDATED_BY',
            'CITATION_STATUS',
            'REC_STATUS',
        ],
    ]) ?>

</div>
