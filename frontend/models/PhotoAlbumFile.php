<?php
namespace frontend\models;

use frontend\models\FileStorage;
use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;


/**
 * This is the model class for table "photoalbum_file".
 *
 * @property int $ID
 * @property int $PHOTOALBUM_ID
 * @property int $FILE_ID
 * @property int $PORYADOK
 * @property string $CREATED
 * @property string $CREATED_BY
 * @property string $UPDATED
 * @property string $UPDATED_BY
 * @property int $REC_STATUS
 *
 * @property FileStorage $fILE
 * @property Photoalbum $PHOTOALBUM
 */
class PhotoAlbumFile extends ActiveRecord
{
   public static function getDb()
    {
        //return Yii::$app->get('mysqlDB');
        // Oracle
        return Yii::$app->get('db');
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'photoalbum_file';
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
    public function rules()
    {
        return [
            [['PHOTOALBUM_ID', 'FILE_ID'], 'required'],
            [['PHOTOALBUM_ID', 'FILE_ID', 'PORYADOK', 'REC_STATUS'], 'integer'],
            [['CREATED', 'UPDATED'], 'safe'],
            [['CREATED_BY', 'UPDATED_BY'], 'string', 'max' => 50],
            [['FILE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => FileStorage::className(), 'targetAttribute' => ['FILE_ID' => 'id']],
            [['PHOTOALBUM_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Photoalbum::className(), 'targetAttribute' => ['PHOTOALBUM_ID' => 'ID']],
//            [['PORYADOK'], 'default', 'value' => function($model) {
//                $count = PhotoAlbumFile::find()->andWhere(['photoalbum_id' => $model->photoalbum_id])->count();
//                return ($count > 0) ? $count++ : 0;
//            }],
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
            'FILE_ID' => Yii::t('app', 'File ID'),
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
    public function getFILE()
    {
        return $this->hasOne(FileStorage::className(), ['id' => 'FILE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPHOTOALBUM()
    {
        return $this->hasOne(Photoalbum::className(), ['ID' => 'PHOTOALBUM_ID']);
    }
}
