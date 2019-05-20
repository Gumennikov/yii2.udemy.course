<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "tag".
 *
 * @property int $id
 * @property string $tag
 *
 * @property PageTag[] $pageTags
 */
class Tag extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tag';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tag'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tag' => 'Tag',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPageTags()
    {
        return $this->hasMany(PageTag::className(), ['tag_id' => 'id']);
    }
}
