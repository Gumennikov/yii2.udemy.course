<?php
namespace frontend\models;

use frontend\models\PhotoAlbumFile;
use frontend\models\PhotoAlbumPage;
use Yii;
use frontend\models\FileStorage;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use tpu\content\models\File;

use yii\web\NotFoundHttpException;

/**
 * This is the model class for table "photoalbum".
 *
 * @property int $ID
 * @property string $TITLE
 * @property string $CREATED
 * @property string $CREATED_BY
 * @property string $UPDATED
 * @property string $UPDATED_BY
 * @property int $REC_STATUS
 * @property int $SITE_LANG_ID
 *
 * @property PhotoalbumFile[] $photoalbumFiles
 * @property PhotoalbumPage[] $photoalbumPages
 */
class PhotoAlbum extends ActiveRecord
{
    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db');
    }

    /**
    * {@inheritdoc}
    */
    public static function tableName()
    {
        return 'photoalbum';
    }

    public static function primaryKey()
    {
        return ['ID'];
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
            [['TITLE'], 'required'],
            [['REC_STATUS', 'SITE_LANG_ID'], 'integer'],
            [['TITLE'], 'string', 'max' => 150],
            [['CREATED_BY', 'UPDATED_BY'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => Yii::t('app', 'ID'),
            'TITLE' => Yii::t('app', 'Title'),
            'CREATED' => Yii::t('app', 'Created'),
            'CREATED_BY' => Yii::t('app', 'Created By'),
            'UPDATED' => Yii::t('app', 'Updated'),
            'UPDATED_BY' => Yii::t('app', 'Updated By'),
            'REC_STATUS' => Yii::t('app', 'Rec Status'),
            'SITE_LANG_ID' => Yii::t('app', 'Site Lang ID'),
        ];
    }


/************************************* Сгенерированные gii связи ***********************************/
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhotoAlbumFiles()
    {
        return $this->hasMany(PhotoAlbumFile::className(), ['PHOTOALBUM_ID' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhotoAlbumPages()
    {
        return $this->hasMany(PhotoAlbumPage::className(), ['PHOTOALBUM_ID' => 'ID']);
    }

/************************************* *************************************************************/


    /**
     * Метод для получения списка фотографий, входящих в заданный фотоальбом
     * При помощи метода via
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFileList()
    {
        return $this->hasMany(FileStorage::class, ['id' => 'file_id'])
            ->viaTable(PhotoAlbumFile::tableName(), ['photoalbum_id' => 'id']);
    }
    // Или, то же самое. При помощи метода via
    public function getAlbumFileList()
    {
        return $this->hasMany(PhotoAlbumFile::class, ['photoalbum_id' => 'id'])
            ->orderBy(['poryadok' => SORT_ASC]);
    }

    public function getFileStorageList()
    {
        return $this->hasMany(FileStorage::class, ['id' => 'file_id'])
            ->via('albumFileList');
    }

    /**
     * Метод для получения подписей к картинкам. Под картинкой в file input выводится содержание поля caption
     * @return array
     */
    public function getFileLinksData()
    {
        return ArrayHelper::toArray($this->fileStorageList,
            [FileStorage::className() =>
                ['caption' => 'id', 'key' => 'id']]);
    }
}
