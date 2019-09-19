<?php
namespace app\models\help;

use Yii;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;

/**
 * Вспомогательные методы для работы с storage
 */
class StorageHelper
{
    /**
     * Метод возвращает абсолютный путь к корневой
     * папке для хранения файлов
     */
    public static function getStoreRoot()
    {
        $storage = ArrayHelper::getValue(Yii::$app->params, 'storage');
        if (!$storage) {
            throw new InvalidConfigException(
                Yii::t('app', 'Необходимо установить параметр «storage» в params.php')
            );
        }

        $storageRoot = ArrayHelper::getValue($storage, 'root');
        if (!$storageRoot) {
            throw new InvalidConfigException(
                Yii::t('app', 'Необходимо установить параметр «storage[root]» в params.php')
            );
        }

        return $storageRoot;
    }

    /**
     * Метод возвращает URL к корневой папке для хранения файлов
     */
    public static function getStoreUrl()
    {
        $storage = ArrayHelper::getValue(Yii::$app->params, 'storage');
        if (!$storage) {
            throw new InvalidConfigException(
                Yii::t('app', 'Необходимо установить параметр «storage» в params.php')
            );
        }

        $storageWeb = ArrayHelper::getValue($storage, 'web');
        if (!$storageWeb) {
            throw new InvalidConfigException(
                Yii::t('app', 'Необходимо установить параметр «storage[web]» в params.php')
            );
        }

        return $storageWeb;
    }
}