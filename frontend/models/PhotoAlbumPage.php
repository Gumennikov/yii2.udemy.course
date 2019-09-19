<?php

namespace frontend\models;

use Yii;
use frontend\models\Page;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "photoalbum_page".
 *
 * @property int $ID
 * @property int $PHOTOALBUM_ID
 * @property int $PAGE_ID
 * @property int $PORYADOK
 * @property string $CREATED
 * @property string $CREATED_BY
 * @property string $UPDATED
 * @property string $UPDATED_BY
 * @property int $REC_STATUS
 *
 * @property Page $PAGE
 * @property Photoalbum $PHOTOALBUM
 */
class PhotoAlbumPage extends \yii\db\ActiveRecord
{
    public static function getDb()
    {
        //return Yii::$app->get('mysqlDB');
        // Oracle
        return Yii::$app->get('db');
    }

    public static function primaryKey()
    {
        return ['id'];
    }

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), []);
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'photoalbum_page';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['PHOTOALBUM_ID', 'PAGE_ID', 'PORYADOK'], 'required'],
            [['PHOTOALBUM_ID', 'PAGE_ID', 'PORYADOK', 'REC_STATUS'], 'integer'],
            [['CREATED', 'UPDATED'], 'safe'],
            [['CREATED_BY', 'UPDATED_BY'], 'string', 'max' => 50],
            [['PAGE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Page::className(), 'targetAttribute' => ['PAGE_ID' => 'id']],
            [['PHOTOALBUM_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Photoalbum::className(), 'targetAttribute' => ['PHOTOALBUM_ID' => 'ID']],
            // Уникальность порядка фотоальбомов на HTML-странице
            ['PORYADOK',
                'unique',
                'targetAttribute' => ['poryadok', 'page_id'],
                'message' => 'Порядок фотоальбомов на HTML-странице должен быть уникальным'
            ],
            [['ID'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => Yii::t('app', 'ID'),
            'PHOTOALBUM_ID' => Yii::t('app', 'Photoalbum ID'),
            'PAGE_ID' => Yii::t('app', 'Page ID'),
            'PORYADOK' => Yii::t('app', 'Poryadok'),
            'CREATED' => Yii::t('app', 'Created'),
            'CREATED_BY' => Yii::t('app', 'Created By'),
            'UPDATED' => Yii::t('app', 'Updated'),
            'UPDATED_BY' => Yii::t('app', 'Updated By'),
            'REC_STATUS' => Yii::t('app', 'Rec Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPAGE()
    {
        return $this->hasOne(Page::className(), ['id' => 'PAGE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPHOTOALBUM()
    {
        return $this->hasOne(Photoalbum::className(), ['ID' => 'PHOTOALBUM_ID']);
    }
}
