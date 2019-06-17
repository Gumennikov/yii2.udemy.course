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
            [['name'], 'string', 'max' => 60],
            ['tip_svyazi_id', 'integer', 'max' => 5],
            ['url', 'page', 'string','max' => 255],
            ['page', 'integer', 'max' => 11],
            ['target', 'boolean'],
//            [['tip_svyazi_id', 'target'], 'safe'],
//            [['tip_menu_id'], 'exist', 'skipOnError' => true, 'targetClass' => TipMenu::className(), 'targetAttribute' => ['tip_menu_id' => 'id']],
//            [['site_lang_id'], 'exist', 'skipOnError' => true, 'targetClass' => SiteLang::className(), 'targetAttribute' => ['site_lang_id' => 'id']],
            [['tip_svyazi_id'], 'exist', 'skipOnError' => true, 'targetClass' => TipSvyazi::className(), 'targetAttribute' => ['tip_svyazi_id' => 'id']],
        ];
        //todo Если тип связи url, то добавляется required. Еще кастомный валидатор для page
        if ($tip_svyazi_id === 1) {}
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
}
