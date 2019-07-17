<?php

namespace frontend\models;

use kartik\tree\models\Tree;
use Yii;
use frontend\models\TipMenu;
use frontend\models\TipSvyazi;
use frontend\models\Module;
use yii\web\JsExpression;

/**
 * This is the model class for table "page_tree".
 *
 * @property string $id
 * @property int $root
 * @property int $lft
 * @property int $rgt
 * @property int $lvl
 * @property string $name
 * @property string $url
 * @property string $icon
 * @property int $icon_type
 * @property int $active
 * @property int $selected
 * @property int $disabled
 * @property int $readonly
 * @property int $visible
 * @property int $collapsed
 * @property int $movable_u
 * @property int $movable_d
 * @property int $movable_l
 * @property int $movable_r
 * @property int $removable
 * @property int $removable_all
 * @property int $child_allowed
 * @property int $site_lang_id
 * @property int $tip_menu_id
 * @property int $tip_svyazi_id
 * @property int $link_id
 * @property int $target
 *
 * @property SiteLang $siteLang
 * @property TipMenu $tipMenu
 * @property TipSvyazi $tipSvyazi
 */
class PageTree extends Tree
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'page_tree';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['root', 'lft', 'rgt', 'lvl', 'icon_type', 'active', 'selected', 'disabled',
                'readonly', 'visible', 'collapsed', 'movable_u', 'movable_d', 'movable_l',
                'movable_r', 'removable', 'removable_all', 'child_allowed', 'site_lang_id', 'link_id'], 'integer'],
            [['name'], 'string', 'max' => 60],
            [['icon', 'url'], 'string', 'max' => 255],
            [['site_lang_id', 'tip_menu_id', 'tip_svyazi_id', 'link_id', 'url'], 'safe'],
            [['site_lang_id'], 'exist', 'skipOnError' => true, 'targetClass' => SiteLang::className(), 'targetAttribute' => ['site_lang_id' => 'id']],
            [['tip_menu_id'], 'exist', 'skipOnError' => true, 'targetClass' => TipMenu::className(), 'targetAttribute' => ['tip_menu_id' => 'id']],
            [['tip_svyazi_id'], 'exist', 'skipOnError' => true, 'targetClass' => TipSvyazi::className(), 'targetAttribute' => ['tip_svyazi_id' => 'id']],

//            [['url'], 'validateUrl', 'skipOnEmpty' => false, /*'skipOnError' => false*/],
//            ['url', 'url'],
//            [['link_id'], 'validatePage', 'skipOnEmpty' => false, /*'skipOnError' => false*/],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'root' => 'Root',
            'lft' => 'Lft',
            'rgt' => 'Rgt',
            'lvl' => 'Lvl',
            'name' => 'Name',
            'url' => 'ЮЭрЭл...',
            'icon' => 'Icon',
            'icon_type' => 'Icon Type',
            'active' => 'Active',
            'selected' => 'Selected',
            'disabled' => 'Disabled',
            'readonly' => 'Readonly',
            'visible' => 'Visible',
            'collapsed' => 'Collapsed',
            'movable_u' => 'Movable U',
            'movable_d' => 'Movable D',
            'movable_l' => 'Movable L',
            'movable_r' => 'Movable R',
            'removable' => 'Removable',
            'removable_all' => 'Removable All',
            'child_allowed' => 'Child allowed',
            'site_lang_id' => 'Site Lang ID',
            'tip_menu_id' => 'Тип меню',
            'tip_svyazi_id' => 'Тип связи',
            'link_id' => 'Связать с ... (link_id)',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSiteLang()
    {
        return $this->hasOne(SiteLang::className(), ['id' => 'site_lang_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipMenu()
    {
        return $this->hasOne(TipMenu::className(), ['id' => 'tip_menu_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipSvyazi()
    {
        return $this->hasOne(TipSvyazi::className(), ['id' => 'tip_svyazi_id']);
    }

//    /**
//    Функции для валидации полей URL и PAGE соответственно
//     */
//    public function validateUrl($attribute, $params)
//    {
//        if ($this->tip_svyazi_id == 1) {
//            if (trim ($this->$attribute) == '') {
//                $this->addError($attribute, 'Необходимо указать URL.');
//                return false;
//            }
//        } return true;
//    }
//
//    public function validatePage($attribute, $params)
//    {
//        if ($this->tip_svyazi_id == 2) {
//            if (trim ($this->$attribute) == '') {
//                $this->addError($attribute, 'Необходимо указать Страницу.');
//                return false;
//            }
//        } return true;
//    }

//    /**
//     * В зависимости от выбранного значения в родительском селекте опрашивает разные таблицы в БД
//     * @param $cat_id
//     * @return array|\yii\db\ActiveRecord[]
//     */
//    public static function getLinkList($cat_id)
//    {
//        if ($cat_id == 1) {
//            $cat_id = Url::find()
//                ->select(['id', 'url as name'])
//                ->orderBy('name')
//                ->asArray()
//                ->all();
//        }
//
//        if ($cat_id == 2) {
//            $cat_id = Page::find()
//                ->select(['id', 'title as name'])
//                ->orderBy('name')
//                ->asArray()
//                ->all();
//        }
//
//        if ($cat_id == 3) {
//            $cat_id = Module::find()
//                ->select(['id', 'title as name'])
//                ->orderBy('name')
//                ->asArray()
//                ->all();
//        }
//
//        return $cat_id;
//    }
//
//    /**
//     * Возвращает список страниц в таблице "Page". По умолчанию в первом селекте выбор будет из этой таблицы.
//     * @param $cat_id
//     * @return array|\yii\db\ActiveRecord[]
//     */
//    public static function getDefaultLinkList()
//    {
//        $cat_id = Page::find()
//            ->select(['id', 'title as name'])
//            ->orderBy('name')
//            ->asArray()
//            ->all();
//
//        return $cat_id;
//    }

}
