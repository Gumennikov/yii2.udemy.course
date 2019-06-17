<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Banner */

$this->title = 'Update Banner: ' . $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Banners', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="banner-update">

    <h1><?= Html::encode($this->title) ?></h1>

<!--    --><?php //foreach (\frontend\models\BannerGallery::find()->all() as $key)
//        {print_r($key['DESCRIPTION']); echo '<br>';} ?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
