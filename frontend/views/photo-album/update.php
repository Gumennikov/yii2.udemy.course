<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PhotoAlbum */

$this->title = Yii::t('app', 'Update Photo Album: {name}', [
    'name' => $model->TITLE,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Photo Albums'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->TITLE, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="photo-album-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
