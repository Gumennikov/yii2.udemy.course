<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use frontend\models\Page;
use frontend\models\TipMenu;
use frontend\models\TipSvyazi;
use yii\widgets\Pjax;
use yii\web\JsExpression;

use kartik\widgets\DepDrop;
//use kartik\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model frontend\models\PageTree */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="page-tree-form">

<!--    --><?php //Pjax::begin(); ?>
<!--    --><?php //$form = ActiveForm::begin([
//        'options' => ['data' => ['pjax' => true]],
//    ]); ?>
    <?php $form = ActiveForm::begin(); ?>

<!--    --><?//= $form->field(TipMenu::find()->one(), 'title')->widget(Select2::classname(), [
//        'data' => ArrayHelper::map(TipMenu::find()->all(), 'id', 'title'),
//        'options' => ['placeholder' => 'Выберите тип меню ...'],
//        'pluginOptions' => [
//            'allowClear' => true,
//        ],
//    ]); ?>

<!-- --><?//= $form->field($model, 'site_lang_id')->widget(Select2::classname(), [
//            'data' => ArrayHelper::map(Page::find()->all(), 'id', 'site_lang_id'),
//            'options' => ['placeholder' => 'Выберите название страницы ...'],
//            'pluginOptions' => [
//                'allowClear' => true,
//            ],
//        ]); ?>

<!-- --><?//= $form->field($model, 'tip_svyazi_id')->widget(Select2::classname(), [
//            'data' => ArrayHelper::map(TipSvyazi::find()->all(), 'id', 'title'),
//            'options' => [
//                'placeholder' => 'Связать пункт с ...',
//                'class'=>'kartik2',
//            ],
//            'pluginOptions' => [
//                'allowClear' => true,
//            ],
//        ]); ?>

<!-- --><?//= $form->field($model, 'tip_svyazi_id')->dropDownList($arrLinkId, [
//            'prompt' => 'выбрать ...',
//            'onchange' =>'
//            $.post("/page/lists?id='.'"+$(this).val(), function (data) {
//            $("select#id").html(data);
//            });',
//    ]); ?>

<!-- --><?php //$model->page_id = Page::find()->where(['id' => $model->link_id])->one()->page_id; ?>

<!-- --><?//= $form->field($model, 'tip_svyazi_id')->dropDownList($tipSvyaziList, ['id' => 'tip-title-id'])?>





    <!--    Реализация dependent dropdown с использованием radioList на тип связи-->

<!--    --><?//= $form->field($model, 'tip_svyazi_id[]')->radioList(TipSvyazi::getTipSvyazi()) ?>

    <!--**************************************************************************************-->

<!--    --><?php
//    $this->registerJs('
//        jQuery("#w0").yiiActiveForm("add",{
//            "id": "link_id",
//            "name": "Связать с ",
//            "container": ".field-link-id",
//            "input": "#link-id",
//            "error": ".help-block.help-block-error",
//            "validate": function(attribute, value, messages, deferred, $form) {
//
//                yii.validation.required(value, messages, {
//                    "message": "Name be blank bug."
//                });
//
//                yii.validation.string(value, messages, {
//                    "message": "Name must be a string.",
//                    "max": 255,
//                    "tooLong": "Name should contain at most 255 characters.",
//                    "skipOnEmpty": 1
//                });
//            }
//        });
//    ');
//    ?>

    <!--    Реализация dependent dropdown с использованием виджета kartik\widgets\Select2-->
    <!--    Last correction 11.06.19-->
    <?= $form->field($model, 'tip_svyazi_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(TipSvyazi::find()->all(), 'id', 'title'),
        'options' => [
            'id' => 'pagetree-tip-svyazi-id',
            'placeholder' => 'Связать пункт с ...',
            //'class'=>'kartik2',
            //'onchange' =>"page-tree/say",
//            'onchange' =>'
//                $.post( "/page-tree/say, function( data ) {
//                  $( "#pagetree-tip-svyazi-id" ).val( data );
//                });
//            ',
//            'pluginEvents' => [
//                'change' => "function() {alert('Change!!!'); }",
//            ],
        ],
        'pluginOptions' => [
            'allowClear' => true,
//            'language' => [
//                'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
//            ],
//            'ajax' => [
//                'url' => Url::to(['page-tree/show-form']),
//                'dataType' => 'json',
//                'data' => new JsExpression('function(params) { return {q:params.term}; }')
//            ],
//            'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
//            'templateResult' => new JsExpression('function(city) { return city.text; }'),
//            'templateSelection' => new JsExpression('function (city) { return city.text; }'),
        ],
    ]); ?>

    <div id="result"></div>

<!--    --><?//= $form->field($model, 'link_id')->widget(Select2::className(), [
//        'data' => ArrayHelper::map(Page::find()->all(), 'id', 'title'),
//        'options' => [
//            'placeholder' => 'Выберите страницу ...',
//        ],
//        'pluginOptions' => [
//            'allowClear' => true,
//        ],
//    ]); ?>
<!---->
<!--    <script>-->
<!--        function userAlert() {-->
<!--            alert('userAlert function result');-->
<!--        }-->
<!--    </script>-->

<!--    --><?//= $form->field($model, 'tip_svyazi_id')->widget(Select2::classname(), [
//        'options' => ['placeholder' => 'Выберите тип связи 2 ...'],
//        'pluginOptions' => [
//            'allowClear' => true,
//            //'minimumInputLength' => 3,
////            'language' => [
////                'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
////            ],
//            'ajax' => [
//                'url' => yii\helpers\Url::to(['page-tree/show-form']),
//                'dataType' => 'json',
//                'data' => new JsExpression('function(params) { return {q:params.term}; }')
//            ],
//            'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
//            'templateResult' => new JsExpression('function(city) { return city.text; }'),
//            'templateSelection' => new JsExpression('function (city) { return city.text; }'),
//        ],
//    ]); ?>




    <!--**************************************************************************************-->


<!--Рабочий-->
<!--    Реализация dependent dropdown с использованием виджета kartik\widgets\DepDrop-->

<!--    --><?//= $form->field($model, 'tip_svyazi_id')->dropDownList(TipSvyazi::getTipSvyazi(),
//    ['prompt' => 'Выбрать ...', 'id' => 'tip-title-id'])?>

<!--    --><?//= $form->field($model, 'tip_svyazi_id')->widget(Select2::classname(), [
//        'data' => ArrayHelper::map(TipSvyazi::find()->all(), 'id', 'title'),
//        'options' => [
//            'id' => 'tip-title-id',
//            'placeholder' => 'Выберите тип связи ...',
//        ],
//        'pluginOptions' => [
//            'allowClear' => true,
//        ],
//    ]); ?>
<!---->
<!--    --><?//= $form->field($model, 'link_id')->widget(DepDrop::className(), [
//        'options'=>['id'=>'link-id'],
//        'pluginOptions'=>[
//            'depends'=>['tip-title-id'],
//            'placeholder'=>'Выбрать...',
//            'url'=>Url::to(['page/list']),
//        ]
//    ]) ?>

<!--**************************************************************************************-->

<!--    DepDrop Advanced Scenario 2-->
<!--    Parent-->
<!--    --><?//= $form->field($model, 'tip_svyazi_id')->dropDownList(TipSvyazi::getTipSvyazi(),
//    ['prompt' => 'Выбрать ...', 'id' => 'tip-svyazi-id']); ?>
<!---->
<!-- Child # 1-->
<!--    --><?//=$form->field($model, 'link_id')->widget(DepDrop::classname(), [
//        'type' => DepDrop::TYPE_SELECT2,
//        'data' => [2 => 'Страницы'],
//        'options' => ['id' => 'link-id', 'placeholder' => 'Выберите с чем связать ...'],
//        'select2Options' => ['pluginOptions' => ['allowClear' => true]],
//        'pluginOptions' => [
//            'depends' => ['tip-svyazi-id'],
//            'url' => Url::to(['/page-tree/link']),
//        ]
//    ]);?>
<!--*************************************************************************************-->

<!-- 06.06.19 Первый селект - kartik select2,
дальше - аякс запрос на подгрузку селекта для page и text input для url-->


    <?= $form->field($model, 'name')->textInput([
        'label' => 'Значение url',
        'disabled' => false,
    ])->hint('Текст подсказки для корректного ввода'); ?>

<!--    --><?//= $form->field($model, 'lft')->textInput() ?>
<!---->
<!--    --><?//= $form->field($model, 'rgt')->textInput() ?>
<!---->
<!--    --><?//= $form->field($model, 'lvl')->textInput() ?>
<!---->
<!--    --><?//= $form->field($model, 'icon')->textInput(['maxlength' => true]) ?>
<!---->
<!--    --><?//= $form->field($model, 'icon_type')->textInput() ?>

<!--    --><?//= $form->field($model, 'active')->textInput() ?>
<!---->
<!--    --><?//= $form->field($model, 'selected')->textInput() ?>
<!---->
<!--    --><?//= $form->field($model, 'disabled')->textInput() ?>
<!---->
<!--    --><?//= $form->field($model, 'readonly')->textInput() ?>
<!---->
<!--    --><?//= $form->field($model, 'visible')->textInput() ?>
<!---->
<!--    --><?//= $form->field($model, 'collapsed')->textInput() ?>
<!---->
<!--    --><?//= $form->field($model, 'movable_u')->textInput() ?>
<!---->
<!--    --><?//= $form->field($model, 'movable_d')->textInput() ?>
<!---->
<!--    --><?//= $form->field($model, 'movable_l')->textInput() ?>
<!---->
<!--    --><?//= $form->field($model, 'movable_r')->textInput() ?>
<!---->
<!--    --><?//= $form->field($model, 'removable')->textInput() ?>
<!---->
<!--    --><?//= $form->field($model, 'removable_all')->textInput() ?>

    <div class="form-group" align="right">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
<!--    --><?php //Pjax::end();?>

</div>
<!--<script>let url = '--><?//= Url::to(['/page-tree/show-form']); ?>//'</script>
//
<?php
//$script = <<< JS
//$(document).ready(function(){
//    $('#tip-svyazi-id').on('change', function() {
//        let val = $('#tip-svyazi-id').val();
//        $.ajax({
//            type: 'POST',
//            url: url,
//            data: {type:val},
//            beforeSend: function(){
//                $('#w0').html('<div style="text-align:center; margin:10px"></div>');
//            },
//            success: function(data){
//                $('#w0').html(data);
//            }
//        });
//    });
//});
//JS;
//$this->registerJs($script);
//?>

<?php
$script = <<< JS
$(document).ready(function(){
    $('#pagetree-tip-svyazi-id').change(function(){
        
        let svyaz_id = $(this).val();
         if (svyaz_id == 1) {
             let u = document.getElementById("result");
             // if (typeof result !== 'undefined') {
             //     console.log('result');
             //     p.removeChild(new_label);
             //     p.removeChild(select_page);
             //     p.removeChild(help_block);
             // }
             let new_label = document.createElement('label');
             new_label.setAttribute('class', 'control-label');
             new_label.setAttribute('for', 'input-url');
             new_label.innerText = 'Введите URL';
             let input_url = document.createElement('input');
             input_url.setAttribute('type', 'text');
             input_url.setAttribute('id', 'pagetree-input-url');
             input_url.setAttribute('class', 'form-control');
             input_url.setAttribute('name', 'PageTree[input-url]');
             input_url.setAttribute('area-required', 'true');
             let help_block = document.createElement('div');
             help_block.setAttribute('class', 'help-block');
             u.appendChild(new_label);
             u.appendChild(input_url);
             u.appendChild(help_block);
         }
         
         if (svyaz_id == 2) {
             let p = document.getElementById("result");
             let new_label = document.createElement('label');
             new_label.setAttribute('class', 'control-label');
             new_label.setAttribute('for', 'select-page');
             new_label.innerText = 'Укажите страницу для привязки';
             let select_page = document.createElement('select');
             select_page.setAttribute('type', 'select');
             select_page.setAttribute('id', 'pagetree-select-page');
             select_page.setAttribute('class', 'form-control');
             select_page.setAttribute('name', 'PageTree[select-page]');
             select_page.setAttribute('area-required', 'true');
             let help_block = document.createElement('div');
             help_block.setAttribute('class', 'help-block');
             p.appendChild(new_label);
             p.appendChild(select_page);
             p.appendChild(help_block);
             }
    });
});
JS;
$this->registerJs($script);
?>
