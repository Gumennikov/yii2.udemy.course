<?php

namespace common\modules\banner\models;

use Yii;

/**
 * This is the model class for table "banner_gallery".
 *
 * @property int $ID
 * @property string $DESCRIPTION
 * @property int $WIDTH
 * @property int $HEIGHT
 * @property string $CREATED
 * @property string $CREATED_BY
 * @property string $UPDATED
 * @property string $UPDATED_BY
 * @property int $REC_STATUS
 *
 * @property Banner[] $banners
 */
class BannerGallery extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'banner_gallery';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['DESCRIPTION', 'WIDTH', 'HEIGHT', 'CREATED_BY', 'UPDATED_BY', 'REC_STATUS'], 'required'],
            [['WIDTH', 'HEIGHT', 'REC_STATUS'], 'integer'],
            [['CREATED', 'UPDATED'], 'safe'],
            [['DESCRIPTION', 'CREATED_BY', 'UPDATED_BY'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'DESCRIPTION' => 'Description',
            'WIDTH' => 'Width',
            'HEIGHT' => 'Height',
            'CREATED' => 'Created',
            'CREATED_BY' => 'Created By',
            'UPDATED' => 'Updated',
            'UPDATED_BY' => 'Updated By',
            'REC_STATUS' => 'Rec Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBanners()
    {
        return $this->hasMany(Banner::className(), ['BANNER_GALLERY_ID' => 'ID']);
    }
}
