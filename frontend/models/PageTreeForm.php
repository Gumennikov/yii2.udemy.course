<?php

namespace frontend\models;

use kartik\tree\models\Tree;
use Yii;
use yii\base\Model;

/**
 * This is the 2nd level model class for table "page_tree".
 *
 * @property int $tip_svyazi_id
 * @property int $link_id
 * @property int $target
 *
 * @property SiteLang $siteLang
 * @property TipMenu $tipMenu
 * @property TipSvyazi $tipSvyazi
 */
class PageTreeForm extends Model
{

    public $name;
    public $tip_svyazi_id;
    public $url;
    public $page;
    public $target;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['name', 'string', 'max' => 60],
            ['page', 'integer', 'max' => 11],
            ['tip_svyazi_id', 'integer', 'max' => 5],
            ['target', 'boolean'],
            [['tip_svyazi_id', 'target'], 'safe'],
            [['tip_svyazi_id'], 'exist', 'skipOnError' => true, 'targetClass' => TipSvyazi::className(), 'targetAttribute' => ['tip_svyazi_id' => 'id']],
            //Валидаторы, действующие в зависимости от выбранных типов связи

            [['url'], 'validateUrl', 'skipOnEmpty' => false, /*'skipOnError' => false*/],
            ['url', 'url'],
            [['page'], 'validatePage', 'skipOnEmpty' => false, /*'skipOnError' => false*/],
            //            ['url', 'required', 'when' => function ($model) {
//                return $model->country == 'USA';
//            }],
            //['url', 'url', 'when' => function ($newmodel) {$newmodel->url;}, 'message' => 'Неверный формат URL. URL должен соответствовать формату "http://youradress.domain".'],
            //['page', 'required', 'when' => function ($tip_svyazi_id) { if ($tip_svyazi_id == '2') {return true;} return false;}],
//            ['page', 'required', 'when' => function () {
//                return false;
//            }],
//            [['tip_menu_id'], 'exist', 'skipOnError' => true, 'targetClass' => TipMenu::className(), 'targetAttribute' => ['tip_menu_id' => 'id']],
//            [['site_lang_id'], 'exist', 'skipOnError' => true, 'targetClass' => SiteLang::className(), 'targetAttribute' => ['site_lang_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Имя ...',
            'tip_svyazi_id' => 'Тип связи ...',
            'url' => 'Связать с ...',
            'page' => 'Стр ...',
            'target' => 'Таргет ...',
        ];
    }

    public static function getTargetList()
    {
        return [0 => 'Открыть в текущем окне', 1 => 'Открыть в новом окне'];
    }

    public function validateUrl($attribute, $params)
    {
        if ($this->tip_svyazi_id == 1) {
            if (trim ($this->$attribute) == '') {
                $this->addError($attribute, 'Необходимо указать URL.');
                return false;
            }
        } return true;
    }

    public function validatePage($attribute, $params)
    {
        if ($this->tip_svyazi_id == 2) {
            if (trim ($this->$attribute) == '') {
                $this->addError($attribute, 'Необходимо указать Страницу.');
                return false;
            }
        } return true;
    }

//    public function validatePage($page, $target, $params)
//    {
//        if ($this->tip_svyazi_id == 2) {
//            if (trim ($this->$page) == '') {
//                $this->addError($page, 'Необходимо указать Страницу.');
//                return false;
//            }
//
//            if (trim ($this->$target) == '') {
//                $this->addError($target, 'Необходимо указать Способ открытия.');
//                return false;
//            }
//        } return true;
//    }
}
