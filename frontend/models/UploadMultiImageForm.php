<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\web\ServerErrorHttpException;
use frontend\models\FileStorage;

use globals\help\ImageHelper;
use globals\db\entity\kdf\content\TipDostupa;
use globals\help\PrilozhenieHelper;
use globals\help\StorageHelper;

class UploadMultiImageForm extends Model {
    /**
     * @var UploadedFile
     */
    public $fileUpload = [];

    public function rules() {
        return [
            //[['fileUpload'], 'file', 'skipOnEmpty' => false, 'extensions' => 'jpg, jpeg, png, bmp, gif'],
            [
                ['fileUpload'], 'image',
                'skipOnEmpty' => false,
                'extensions' => 'jpg, jpeg, png, gif',
                'minWidth' => 100, 'minHeight' => 100,
                //'maxWidth' => 1200, 'maxHeight' => 1200,
            ],
        ];
    }

    public function attributeLabels() {
        return [
            'fileUpload' => Yii::t('app','Загрузить изображение'),
        ];
    }

    /**
     *
     */
    public function uploadImage() {
        // Получить абсолютный путь к корневой папке для хранения файлов
        $pathStorage = StorageHelper::getStoreRoot();
//        $pathStorage = StorageHelper::getStoreRoot();
        // Объект SiteLang
        $siteLang = PrilozhenieHelper::getSiteLang();

        $dirName = 'site-' . $siteLang->id;

        // Относительный путь к папке для сохранение файла
        $dirSave = 'common/images/' . $dirName;
        // Абсолютный путь к папке для сохранение файла
        $pathSave = $pathStorage . '/' . $dirSave;

        if (!file_exists($pathSave)) {
            //print_r($pathSave);die();
            if (!mkdir($pathSave, 0777)) {
                throw new ServerErrorHttpException(
                    Yii::t('app', 'Невожможно создать директорию: ').$pathSave);
            }
        }

        if (!$this->validate()) {
            return false;
        }

        // Сформировать имя файла
        $fileName = md5(Yii::$app->security->generateRandomString(32)) . '_' . time()
            . '.' . $this->fileUpload->extension;

        // Путь к файлу, который нужно сохранить в БД
        $fileUrl = $dirSave . '/' .  $fileName;

        $transaction = Yii::$app->db->beginTransaction();
        try {
            // Сохранить информацию о изображении в БД
            $fileStorage = new FileStorage();
            $isSaveInBd = $fileStorage->saveNewInstance($this->fileUpload, $siteLang,
                $fileUrl, TipDostupa::ACCESS_PUBLIC, true);
            if ($isSaveInBd == false) {
                $transaction->rollBack();
                return false;
            }

            // Сохранить изображение в файловой системе на сервере
            //if ( $this->fileUpload->saveAs($pathSave . '/' .  $fileName) ) {  // стандартное сохранение
            if ( $this->saveImage($pathSave . '/' .  $fileName) ) {  // своя реализация
                $transaction->commit();
            }
            else {
                $transaction->rollBack();
                return false;
            }
        }
        catch(\Throwable $ex) {
            $transaction->rollBack();
            throw $ex;
        }

        return true;
    }

    /**
     * Метод сохраняет изображение в файловой системе на сервере
     *
     * $path: абсолютный путь до файла, для его сохранения
     */
    private function saveImage($path) {
        $result = false;

        // Временное имя файла, с которым принятое изображение
        // было сохранено, во временной директории сервера
        $tmpImage = $this->fileUpload->tempName;

        // Размеры и тип исходного изображения
        list($srcWidth, $srcHeight, $srcType, $attr) = getimagesize( $tmpImage );

        // Вычислить новые размеры изображения, в соответствии
        // с заданными максимальными размерами
        $newSize = ImageHelper::calculateNewSizeImage($tmpImage, 1920, 1200);

        $src = imageCreateFromString( file_get_contents($tmpImage) );
        $dst = imageCreateTrueColor($newSize[0], $newSize[1]);
        // Масштабирование изображения
        $result = imageCopyResampled($dst, $src,
            0, 0, 0, 0, $newSize[0], $newSize[1], $srcWidth, $srcHeight);

        if ($result) {
            // Сохранить изображение
            switch ($srcType) {
                case IMAGETYPE_JPEG:
                    $result = imagejpeg($dst, $path);
                    break;
                case IMAGETYPE_GIF:
                    $result = imagegif($dst, $path);
                    break;
                case IMAGETYPE_PNG:
                    $result = imagepng($dst, $path);
                    break;
                default:
                    throw new ServerErrorHttpException(Yii::t('app', 'Недопустимый формат изображения'));
            }
        }

        imageDestroy( $src );
        imageDestroy( $dst );

        return $result;
    }
}