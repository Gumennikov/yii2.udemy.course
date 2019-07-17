<?php
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\models\TipSvyazi;
use kartik\widgets\Select2;
use yii\helpers\Html;
use frontend\models\Page;
use frontend\models\PageTreeForm;
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

<!--    --><?php
//    if ($newmodel->tip_svyazi_id == 1) {echo $form->field($newmodel, 'url')->textInput();}
//
//    if ($newmodel->tip_svyazi_id == 2) {
//        echo $form->field($newmodel, 'name')->widget(Select2::class, [
//            'initValueText' => empty($newmodel->page) ? '' : Page::findOne($newmodel->page)->title,
//            //'data' => ArrayHelper::map(Page::find()->all(), 'id', 'title'),
//            'options' => ['placeholder' => 'Выберите название страницы...'],
//            'pluginOptions' => [
//                'allowClear' => true,
////                'minimumInputLength' => 2,
////                'language' => [
////                    'errorLoading' => new JsExpression("function () { return 'Ожидание результатов...'; }"),
////                ],
////                'ajax' => [
////                    'url' => $url,
////                    'datatype' => 'json',
////                    'data' => new JsExpression('function(params) { return {q:params.term}; }')
////                ],
////                'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
////                'templateResult' => new JsExpression('function(title) { return title.text; }'),
////                'templateSelection' => new JsExpression('function (title) { return title.text; }'),
//            ],
//        ]);
//        echo $form->field($newmodel, 'target')->textInput();
//    }?>
<!--<div id="result"></div>-->

    <?php echo $form->field($newmodel, 'url')->textInput(['disabled' => 'disabled']);

        echo $form->field($newmodel, 'page')->widget(Select2::className(), [
            'data' => ArrayHelper::map(Page::find()->all(), 'id', 'title'),
            'id' => 'page-select',
            'disabled' => true,
            'options' => [
                'placeholder' => 'Выберите страницу ...',
            ],
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ]);

//        echo $form->field($newmodel, 'target')->dropDownList([
//            '0' => 'Открыть в текущем окне',
//            '1' => 'Открыть в новом окне'
//        ]);

        echo $form->field($newmodel, 'target')->widget(Select2::className(), [
            'data' => PageTreeForm::getTargetList(),
            'disabled' => true,
            'options' => [
                'placeholder' => 'Выберите способ открытия ...',
            ],
        ]); ?>

<!--    --><?//= $form->field($newmodel, 'url')->textInput() ?>
<!---->
<!--    --><?//= $form->field($newmodel, 'page')->widget(Select2::className(), [
//        'data' => ArrayHelper::map(Page::find()->all(), 'id', 'title'),
//        'options' => [
//            'placeholder' => 'Выберите страницу ...',
//        ],
//        'pluginOptions' => [
//            'allowClear' => true,
//        ],
//    ]); ?>
<!---->
<!--    --><?//= $form->field($newmodel, 'target')->dropDownList([
//        '0' => 'Открыть в текущем окне',
//        '1' => 'Открыть в новом окне'
//    ]) ?>

    <div class="form-group" align="right">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

<?php ActiveForm::end(); ?>

</div>

<pre><?= print_r($newmodel)?></pre>

<?php
$script = <<< JS
$(document).ready(function(){
    $('#pagetree-tip-svyazi-id').change(function(){
        let svyaz_id = $(this).val();
        if (svyaz_id == 1) {
            $('#pagetreeform-url').prop('disabled', false);
            $('#pagetreeform-url').hide();
            $('#pagetreeform-page').prop('disabled', true);
            $('#pagetreeform-target').prop('disabled', true);
        }
        if (svyaz_id == 2) {
            $('#pagetreeform-url').prop('disabled', true);
             $('#pagetreeform-url').show();
            $('#pagetreeform-page').prop('disabled', false);
            $('#pagetreeform-target').prop('disabled', false);
        }
    });
});
JS;
$this->registerJs($script);
?>

<?php
//$script = <<< JS
//$(document).ready(function(){
//    $('#pagetree-tip-svyazi-id').change(function(){
//
//        let svyaz_id = $(this).val();
//         if (svyaz_id == 1) {
//             let u = document.getElementById("result");
//             let new_label = document.createElement('label');
//             new_label.setAttribute('class', 'control-label');
//             new_label.setAttribute('for', 'input-url');
//             new_label.innerText = 'Введите URL';
//             let input_url = document.createElement('input');
//             input_url.setAttribute('type', 'text');
//             input_url.setAttribute('id', 'pagetree-input-url');
//             input_url.setAttribute('class', 'form-control');
//             input_url.setAttribute('name', 'PageTree[input-url]');
//             input_url.setAttribute('area-required', 'true');
//             let help_block = document.createElement('div');
//             help_block.setAttribute('class', 'help-block');
//             u.appendChild(new_label);
//             u.appendChild(input_url);
//             u.appendChild(help_block);
//         }
//
//         if (svyaz_id == 2) {
//             let p = document.getElementById("result");
//             let new_label = document.createElement('label');
//             new_label.setAttribute('class', 'control-label');
//             new_label.setAttribute('for', 'select-page');
//             new_label.innerText = 'Укажите страницу для привязки';
//             let select_page = document.createElement('select');
//             select_page.setAttribute('type', 'select');
//             select_page.setAttribute('id', 'pagetree-select-page');
//             select_page.setAttribute('class', 'form-control');
//             select_page.setAttribute('name', 'PageTree[select-page]');
//             select_page.setAttribute('area-required', 'true');
//             let help_block = document.createElement('div');
//             help_block.setAttribute('class', 'help-block');
//             p.appendChild(new_label);
//             p.appendChild(select_page);
//             p.appendChild(help_block);
//             }
//    });
//});
//JS;
//$this->registerJs($script);
//?>


