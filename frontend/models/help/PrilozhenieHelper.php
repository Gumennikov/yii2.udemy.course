<?php
namespace app\models\help;
// class: tpu\prilogenie\helpers\PrilogenieHelper; Semenov

use Yii;
use yii\base\InvalidConfigException;
use yii\web\ServerErrorHttpException;
use yii\helpers\ArrayHelper;

use globals\db\entity\tpu\prilozhenie\SiteLang;

/**
 * Вспомогательные методы для работы с приложениями
 */
class PrilozhenieHelper
{
    /**
     * Метод возвращает идентификатор текущего приложения
     */
    public static function getId()
    {
        $prilozhenieId = ArrayHelper::getValue(Yii::$app->params, 'prilozhenieDbId');
        if (!$prilozhenieId) {
            throw new InvalidConfigException(
                Yii::t('app', 'Необходимо установить параметр «prilozhenieDbId» в params.php')
            );
        }

        return $prilozhenieId;
    }

    /**
     * Метод возвращает идентификатор сайта внутри текущего приложения
     */
    public static function getSiteId()
    {
        $siteId = ArrayHelper::getValue(Yii::$app->params, 'siteInIpkDbId');
        if (!$siteId) {
            throw new InvalidConfigException(
                Yii::t('app', 'Необходимо установить параметр «siteInIpkDbId» в params.php')
            );
        }

        return $siteId;
    }

    /**
     * Метод возвращает один объект SiteLang (таблица APP_NTB.site_lang)
     */
    public static function getSiteLang($languageId=null)
    {
        $prilozhenieId = self::getId();
        $siteId = self::getSiteId();

        // Язык
        if ($languageId === null) {
            // Текущий язык приложения
            $languageId = self::getLanguageIdByMark(Yii::$app->language);
        }

        $siteLang = SiteLang::find()->where([
            'prilogenie_id' => $prilozhenieId,
            'site_id' => $siteId,
            'language_id' => $languageId,
        ])->one();

        if (!$siteLang) {
            throw new ServerErrorHttpException(
                Yii::t('app', 'Неверно настроены параметры приложения')
            );
        }

        return $siteLang;
    }

    /**
     * Метод возвращает массив объектов SiteLang (таблица APP_NTB.site_lang)
     * без учет языка
     */
    public static function getSitesWithoutLang()
    {
        $prilozhenieId = self::getId();
        $siteId = self::getSiteId();

        $siteList = SiteLang::find()->where([
            'prilogenie_id' => $prilozhenieId,
            'site_id' => $siteId,
        ])->all();

        if (!$siteList) {
            throw new ServerErrorHttpException(
                Yii::t('app', 'Неверно настроены параметры приложения')
            );
        }

        return $siteList;
    }

    /**
     * Метод возврщает список id-сайтов для текущего приложения, без учета языка
     */
    public static function getSiteIdsWithoutLang()
    {
        // Получить список сайтов для текущего приложения,
        // без учета языка
        $siteList = self::getSitesWithoutLang();

        $siteIds = [];
        foreach ($siteList as $key => $siteLang) {
            $siteIds[] = $siteLang->id;
        }

        return $siteIds;
    }

    /**
     * Метод возврщает идентификатор языка по его метке ('ru', 'en' и т.д.)
     */
    public static function getLanguageIdByMark($mark='ru')
    {
        // Массив идентификаторов языков
        $langIds = ArrayHelper::getValue(Yii::$app->params, 'languagesMap');
        if (!$langIds) {
            throw new InvalidConfigException(
                Yii::t('app', 'Необходимо установить параметр «languagesMap» в params.php')
            );
        }

        //$languageId = null;

        switch ($mark) {
            case 'ru':
                $languageId = ArrayHelper::getValue($langIds, 'ru');
                if ($languageId == null) {
                    throw new InvalidConfigException(
                        Yii::t('app', 'Необходимо установить идентификатор русского языка в params.php')
                    );
                }
                break;
            case 'en':
                $languageId = ArrayHelper::getValue($langIds, 'en');
                if ($languageId == null) {
                    throw new InvalidConfigException(
                        Yii::t('app', 'Необходимо установить идентификатор английского языка в params.php')
                    );
                }
                break;
            // По умолчанию, язык прилложения русский
            default:
                $languageId = ArrayHelper::getValue($langIds, 'ru');
                if ($languageId == null) {
                    throw new InvalidConfigException(
                        Yii::t('app', 'Необходимо установить идентификатор русского языка в params.php')
                    );
                }
        }

        return $languageId;
    }
}