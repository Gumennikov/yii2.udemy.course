<?php
use yii\bootstrap\Alert;
use yii\helpers\Html;
use yii\widgets\LinkPager;
?>
<?php
$msgFlash = Yii::$app->session->getFlash('flashMessage');
// Всплывающее сообщение
if (isset($msgFlash)) {
    echo Alert::widget([
        'options' => ['class' => 'alert-info'],
        'body' => $msgFlash,
    ]);
}

/* POST-запрос */
/**
$linkDelete = Html::beginForm(['/content/picture/delete-invalid-records'],'post')
    . Html::submitButton(Yii::t('app','Удалить битые ссылки'), ['class' => 'btn btn-success'])
. Html::endForm();
**/
// Или
/**/
$linkDelete = Html::a(Yii::t('app','Удалить битые ссылки'),
    ['/content/picture/delete-invalid-records'],
    [
        'class' => 'btn btn-danger',
        //'class' => 'btn btn-link',
        'data' => [
            'method' => 'post',
            'confirm' => Yii::t('app','Вы действительно хотите<br/>выполнить данную операцию?'),
        ],
    ]
);
/**/
echo $linkDelete;
?>
<br/><br/><br/><br/>

<?php
// $images: двумерный массив с атрибутами изображений
if (count($images) == 0):
?>
    <p>Картинки не найдены</p>
<?php endif; ?>
<?php foreach ($images as $img): ?>
    <img src="<?= $img['url']; ?>" <?= $img['size']; ?> />
    <br/>
    <!-- Показать Url для картинки -->
    <?= $img['url']; ?>
    <hr/>
<?php endforeach; ?>
<?php
// Пакзать панель пагинации
echo LinkPager::widget([
    'pagination' => $pagination,
]);
?>
