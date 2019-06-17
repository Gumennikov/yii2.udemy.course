<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "k_tip_menu".
 *
 * @property int $id
 * @property string $title
 *
 * @property PageTree[] $pageTrees
 */
class TipMenu extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'k_tip_menu';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'title'], 'required'],
            [['id'], 'integer'],
            [['title'], 'string', 'max' => 255],
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
            'title' => 'Title',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPageTrees()
    {
        return $this->hasMany(PageTree::className(), ['tip_menu_id' => 'id']);
    }
}
