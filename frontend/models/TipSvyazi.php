<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "k_tip_svyazi".
 *
 * @property int $id
 * @property string $title
 *
 * @property PageTree[] $pageTrees
 */
class TipSvyazi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'k_tip_svyazi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPageTrees()
    {
        return $this->hasMany(PageTree::className(), ['tip_svyazi_id' => 'id']);
    }

    /**
     * Получаем все типы связи, содержащиеся в таблице k_tip_svyazi
     * @return array
     */
    public static function getTipSvyazi()
    {
        return self::find()->select(['title', 'id'])->indexBy('id')->column();
    }
}
