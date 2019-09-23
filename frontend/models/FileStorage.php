<?php

namespace frontend\models;

use Faker\Provider\File;
use Yii;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\UploadedFile;
use yii\image\drivers\Image;
use yii\image\ImageDriver;
/**
 * This is the model class for table "file_storage".
 *
 * @property int $id
 * @property string $file_url
 * @property string $created
 * @property string $created_by
 * @property string $updated
 * @property string $updated_by
 * @property int $rec_status
 * @property int $site_lang_id
 * @property string $ftype
 * @property int $fsize
 * @property int $is_image
 * @property string $origin
 * @property int $tip_dostupa_id
 * @property int $sort
 * @property int $title
 * @property int $ip_address
 *
 * @property SiteLang $siteLang
 */
class FileStorage extends \yii\db\ActiveRecord
{
    /**
     * @var UploadedFile
     */

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'file_storage';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['file_url'], 'required'],
            [['is_image', 'title', 'ip_address'], 'safe'],
            [['ip_address'], 'string'],
            [['rec_status', 'site_lang_id', 'fsize', 'is_image', 'tip_dostupa_id', 'sort'], 'integer'],
//            [['file_url', 'created_by', 'updated_by', 'origin'], 'string', 'max' => 255],
            [['ftype'], 'string', 'max' => 20],
            [['file_url'], 'unique'],
            [['sort'], 'default', 'value' => function($model) {
                $count = FileStorage::find()->andWhere(['is_image' => $model->is_image])->count();
                return ($count > 0) ? $count++ : 0;
                }],
//            [['site_lang_id'], 'exist', 'skipOnError' => true, 'targetClass' => SiteLang::className(), 'targetAttribute' => ['site_lang_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'file_url' => Yii::t('app', 'File Url'),
            'created' => Yii::t('app', 'Created'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated' => Yii::t('app', 'Updated'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'rec_status' => Yii::t('app', 'Rec Status'),
            'site_lang_id' => Yii::t('app', 'Site Lang ID'),
            'ftype' => Yii::t('app', 'Ftype'),
            'fsize' => Yii::t('app', 'Fsize'),
            'is_image' => Yii::t('app', 'Is Image'),
            'origin' => Yii::t('app', 'Origin'),
            'tip_dostupa_id' => Yii::t('app', 'Tip Dostupa ID'),
            'title' => Yii::t('app', 'Заголовок'),
            'ip_address' => Yii::t('app', 'IP-адрес'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSiteLang()
    {
        return $this->hasOne(SiteLang::className(), ['id' => 'site_lang_id']);
    }

//    public function upload()
//    {
//        if ($this->validate()) {
//            $dir = Yii::getAlias('@storage') . '/';
//            $this->attachment->saveAs($dir . $this->attachment);
//            return true;
//        } else {
//            return false;
//        }
//    }

    /**
     * Логика загрузки файлов (картинок) в директорию проекта
     * Дирректория, в которую кладутся картинки: D:\Open_server_5.2.9\OSPanel\domains\yii2.udemy.course/frontend/web/uploads/
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        if ($attachment = UploadedFile::getInstance($this, 'attachment')) {
        //if ($attachment = UploadedFile::getInstanceByName('FileStorage[attachment]')) {
            $dir = Yii::getAlias('@storage');
            //В случае, если картинка с таким именем уже существует, удаляем файл
            if (file_exists($dir . '/' . $this->file_url)) {
                unlink($dir . '/' . $this->file_url);
            }
            $this->file_url = strtotime('now').'_'.Yii::$app->getSecurity()->generateRandomString(6). '.' .$attachment->extension;
            $attachment->saveAs($dir . '/' . $this->file_url);
            $imag = Yii::$app->image->load($dir . '/' . $this->file_url);
            $imag->background('#fff', 0);
            $imag->resize('50', '50', Image::INVERSE);
            $imag->crop('50', '50');
            $imag->save($dir . '/50x50/' . $this->file_url, 90);
        }
        return parent::beforeSave($insert);
    }

    public function getImages()
    {
        return self::find()->andWhere(['is_image' => 1])->orderBy('sort');
    }

    public function getImagesLinks()
    {
        return ArrayHelper::getColumn($this->images, 'imageUrl');
    }

    public function getImagesLinksData()
    {
        return ArrayHelper::toArray($this->images,
            [FileStorage::className() =>
                ['caption' => 'file_url', 'key' => 'id']]);
    }

    public function getImageUrl()
    {
        if ($this->file_url){
//            $path = $this->file_url;
            $path = str_replace('G:\Open_server_5.2.9\OSPanel\domains\yii2.udemy.course/frontend/web', '', $this->file_url);
        } else {
//            $path = 'D:/Open_server_5.2.9/OSPanel/domains/yii2.udemy.course/frontend/web/uploads/images/nophoto.jpg';
            $path = '/uploads/images/nophoto.jpg';
        }
        return Html::img($path, ['style'=>'max-width: 60px; max-height: 60px;"']);
    }

    /**
     * Изменение порядка файлов (картинок) при удалении картинки
     * @return bool
     */
    public function beforeDelete()
   {
       if (parent::beforeDelete()){
           FileStorage::updateAllCounters(['sort' => -1], [
               'and',['is_image' => 1,'id'=>$this->id],['>', 'sort', $this->sort]
           ]);
           return true;
       } else {
           return false;
       }
   }

    public function getSmallImage()
    {

    }
}
//
///**
// * @return array
// * @throws \yii\base\Exception
// * @throws \yii\web\BadRequestHttpException
// */
//public function actionSaveImage()
//{
//    $this->enableCsrfValidation = false;
//    if (Yii::$app->request->isPost) {
//        $post = Yii::$app->request->post();
//        $dir = Yii::getAlias('@images') . '/';
//        if (!file_exists($dir)) {
//            FileHelper::createDirectory($dir);
//        }
////            $result_link = 'http://yii2.udemy.course/index.php/en12321312312312';
////            $result_link = str_replace('http://yii2.udemy.course/index.php/en',
////                    \yii\helpers\Url::home(true)).'uploads/images/'.$post['ftype'].'/';
//        //$file = $_FILES['attachment']['name'][0];
//        //$file = UploadedFile::getInstanceByName('FileStorage[attachment]');
//        $model = new FileStorage();
//        $model->attachment = UploadedFile::getInstance($model, 'attachment');
//        var_dump($model->attachment); die();
//        $model->file_url = strtotime('now') . '_' . Yii::$app->getSecurity()->generateRandomString(6) . '.' . $file->extension;
//        $model->load($post);
//        $model->validate();
//
//
//        if ($model->hasErrors()) {
//            $result = [
//                'error' => $model->getFirstError('attachment')
//            ];
//        } else {
//            if ($model->attachment->saveAs($dir . $model->file_url)) {
//                $imag = Yii::$app->image->load($dir . $model->file_url);
//                $imag->resize(800, NULL, Image::PRECISE)->save($dir . $model->file_url, 85);
//                $result = [
//                    'filelink' => 'http://yii2.udemy.course/index.php/en/' . $dir . $model->file_url,
//                    'filename' => $model->file_url,
//                ];
//            } else {
//                $result = [
////                        'error' => Yii::t('vova07/imperavi', 'ERROR_CAN_NOT_UPLOAD'),
//                    'error' => 'Ошибка 001. Файл не загрузился',
//                ];
//            }
//            $model->save();
//        }
//        Yii::$app->response->format = Response::FORMAT_JSON;
//
//        return $result;
//    } else {
//        throw new \yii\web\BadRequestHttpException('Only POST is allowed');
//    }
//}
