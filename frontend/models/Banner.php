<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "banner".
 *
 * @property int $ID
 * @property int $BANNER_GALLERY_ID
 * @property string $TEXT
 * @property string $LINK_URL
 * @property string $FILE_URL
 * @property int $REC_STATUS
 * @property int $TARGET_ID
 * @property int $PORYADOK
 * @property string $CREATED
 * @property string $CREATED_BY
 * @property string $UPDATED
 * @property string $UPDATED_BY
 *
 * @property BannerGallery $bANNERGALLERY
 */
class Banner extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'banner';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['BANNER_GALLERY_ID', 'TEXT', 'LINK_URL', 'FILE_URL', 'TARGET_ID', 'PORYADOK'], 'required'],
            [['BANNER_GALLERY_ID', 'REC_STATUS', 'TARGET_ID', 'PORYADOK'], 'integer'],
            [['CREATED', 'UPDATED'], 'safe'],
            [['TEXT', 'LINK_URL', 'FILE_URL', 'CREATED_BY', 'UPDATED_BY'], 'string', 'max' => 255],
            [['BANNER_GALLERY_ID'], 'exist', 'skipOnError' => true, 'targetClass' => BannerGallery::className(), 'targetAttribute' => ['BANNER_GALLERY_ID' => 'ID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'BANNER_GALLERY_ID' => 'Banner Gallery ID',
            'TEXT' => 'Text',
            'LINK_URL' => 'Link Url',
            'FILE_URL' => 'File Url',
            'REC_STATUS' => 'Rec Status',
            'TARGET_ID' => 'Target ID',
            'PORYADOK' => 'Poryadok',
            'CREATED' => 'Created',
            'CREATED_BY' => 'Created By',
            'UPDATED' => 'Updated',
            'UPDATED_BY' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBannerGallery()
    {
        return $this->hasOne(BannerGallery::className(), ['ID' => 'BANNER_GALLERY_ID']);
    }

//    public function getAllBannerGalleries()
//    {
//        return $this->hasMany(BannerGallery::className(), ['ID' => 'BANNER_GALLERY_ID']);
//    }
}
