<?php
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\models\TipSvyazi;
use kartik\widgets\Select2;
/**
 *
 */
?>


<div class="page-tree-newupdate">
<div><?php $form = ActiveForm::begin(); ?>

     <?= $form->field($newmodel, 'name')->textInput()->hint('Текст подсказки для корректного ввода'); ?>

    <?= $form->field($newmodel, 'tip_svyazi_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(TipSvyazi::find()->all(), 'id', 'title'),
        'options' => [
            'id' => 'pagetree-tip-svyazi-id',
            'placeholder' => 'Связать пункт с ...',
        ],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]); ?>

    <div id="result"></div>

    <?php ActiveForm::end(); ?>

</div>

<pre><?= print_r($newmodel)?></pre>