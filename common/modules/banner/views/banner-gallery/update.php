<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\banner\models\BannerGallery */

$this->title = 'Update Banner Gallery: ' . $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Banner Galleries', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="banner-gallery-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
