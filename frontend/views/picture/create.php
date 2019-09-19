<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model globals\db\entity\content\FileStorage */

$this->title = 'Create File Storage';
$this->params['breadcrumbs'][] = ['label' => 'File Storages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="file-storage-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
