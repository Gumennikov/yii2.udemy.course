<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model globals\db\entity\content\FileStorage */

$this->title = 'Update File Storage: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'File Storages', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="file-storage-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
