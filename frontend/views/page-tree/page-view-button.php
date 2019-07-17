<?php
/**
 * Created by PhpStorm.
 * User: gumennikov
 * Date: 15.07.2019
 * Time: 11:44
 */
?>

<div class="row">
    <?= $form->field($node, 'link_id')->textInput()?>
<!--    --><?//= $form->field($action, 'link_id')?>
    <?= \yii\helpers\Html::submitButton('Отрендерить page-view1', ['class' => 'btn btn-default']) ?>
    <?= \yii\helpers\Html::a('Отрендерить page-view2', 'https://google.com') ?>
</div>
