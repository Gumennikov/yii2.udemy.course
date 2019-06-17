<?php

use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model frontend\models\PageTree */

$this->title = 'Update Page Tree: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Page Trees', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<pre><?php print_r($model->errors); ?></pre>

<?php Pjax::begin();?>
<?php Pjax::end();?>

<div class="page-tree-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
