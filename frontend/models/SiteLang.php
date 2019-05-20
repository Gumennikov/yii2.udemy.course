<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "site_lang".
 *
 * @property int $id
 * @property int $prilogenie_id
 * @property int $site_id
 * @property int $language_id
 *
 * @property Page $page
 */
class SiteLang extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'site_lang';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['prilogenie_id', 'site_id', 'language_id'], 'required'],
            [['prilogenie_id', 'site_id', 'language_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'prilogenie_id' => 'Prilogenie ID',
            'site_id' => 'Site ID',
            'language_id' => 'Language ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPage()
    {
        return $this->hasOne(Page::className(), ['id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLanguage()
    {
        return $this->hasOne(Language::class, ['id' => 'language_id']);
    }
}
