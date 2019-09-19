<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model globals\db\entity\content\FileStorage */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'File Storages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="file-storage-view">

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
            'file_url:url',
            'created',
            'created_by',
            'updated',
            'updated_by',
            'rec_status',
            'site_lang_id',
            'ftype',
            'fsize',
            'is_image',
            'origin',
            'tip_dostupa_id',
            'hash',
            'title',
        ],
    ]) ?>

</div>
