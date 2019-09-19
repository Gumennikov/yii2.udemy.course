<?php //header("Content-Type: application/json", true); ?>

<?php print_r("Представление test-page-select2");?>
<?="<br>"?>
<?= '<label for="input1">Поле 1 для формы для атрибутов галереи</label><input type="text" name="input1">'?>
<?="<br>"?>
<?= '<label for="input2">Поле 2 для формы для атрибутов галереи</label>
<select>
<option>Галерея</option>
<option>Галерейка</option>
<option>Галереюшка</option>
</select>'?>
<?="<br>"?>
<?= '<input type="button" name="input3" value="Отправить формочку">'?>


<?php $data = [1 => 'Red', 2 => 'Blue'];?>
<?php // Without model and implementing a multiple select
echo '<label class="control-label">Цвета</label>';
echo \kartik\widgets\Select2::widget([
    'name' => 'state_10',
    'data' => $data,
    'options' => [
        'placeholder' => 'Select provinces ...',
        'multiple' => true
    ],
]);?>
