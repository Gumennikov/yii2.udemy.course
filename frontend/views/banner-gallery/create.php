<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\BannerGallery */

$this->title = 'Create Banner Gallery';
$this->params['breadcrumbs'][] = ['label' => 'Banner Galleries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="banner-gallery-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
