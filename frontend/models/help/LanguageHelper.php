<?php
namespace app\models\help;

use Yii;

/**
 * Класс содержит методы для выбора\установки языка (в административной части),
 * для которого будет создаваться контент сайта
 */
class LanguageHelper
{
    public static function getCurrentLangIdForContent()
    {
        // Если пользователь ранее уже выбрал язык, для которого
        // будет создавать контент, попытка получить идентификатор
        // языка из ранее установленного в cookies

        // get cookies from the request
        $reqCooki = Yii::$app->request->cookies;
        $currentLangId = $reqCooki->getValue('languageId', 0);

        // Если язык не удалось определить
        if ($currentLangId === 0) {
            // Получить текущий язык сайта
            $currentLangId = PrilozhenieHelper::getLanguageIdByMark(Yii::$app->language);
        }

        return $currentLangId;
    }
}