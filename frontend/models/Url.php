<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "url".
 *
 * @property int $id
 * @property string $url
 * @property string $redirect
 */
class Url extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'url';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['url'], 'required'],
            [['url', 'redirect'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'url' => Yii::t('app', 'Url'),
            'redirect' => Yii::t('app', 'Redirect'),
        ];
    }
}
