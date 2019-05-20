<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "language".
 *
 * @property int $id
 * @property string $language
 *
 * @property SiteLang[] $siteLangs
 */
class Language extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'language';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'language'], 'required'],
            [['id'], 'integer'],
            [['language'], 'string', 'max' => 45],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'language' => 'Language',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSiteLangs()
    {
        return $this->hasMany(SiteLang::class, ['language_id' => 'id']);
    }
}
