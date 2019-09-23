<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Page */

$this->title = 'Update Page: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Pages', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>

<?php
echo 'ip_address: ';
$ip_address = Yii::$app->request->userIP;
var_dump($ip_address);
echo '<br><br>';
$ip_2long = ip2long($ip_address);
var_dump($ip_2long);
echo '<br><br>';
$ip_strval = strval($ip_address);
var_dump($ip_strval);
echo '<br><br>';
echo 'ip2long($ip_address): ';
var_dump(ip2long($ip_address));
echo '<br><br>';
echo 'long2ip($ip_2long): ';
var_dump(long2ip($ip_2long));
echo '<br><br>';
?>

<div class="page-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
