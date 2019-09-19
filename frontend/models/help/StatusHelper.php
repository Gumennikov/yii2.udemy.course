<?php
namespace globals\help;

use Yii;

use globals\db\entity\kdf\system\RecordStatus;

/**
 * Класс содержит методы для работы со статусами записей в таблицах БД
 */
class StatusHelper
{
    /**
     * Метод возвращает поле rec_status у объекта как строку
     */
    public static function formatToString($recStatus) {
        switch ($recStatus) {
            case RecordStatus::PUBLISHED:
                $res = Yii::t('app', 'Опубликовано');
                break;
            case RecordStatus::DRAFT:
                $res = Yii::t('app', 'Черновик');
                break;
            case RecordStatus::AWAITING_REVIEW:
                $res = Yii::t('app', 'Ожидает проверки');
                break;
            case RecordStatus::LOCKED:
                $res = Yii::t('app', 'Заблокировано');
                break;
            case RecordStatus::CANCELLED_BY_ADMINISTRATOR:
                $res = Yii::t('app', 'Отменено администратором');
                break;
            case RecordStatus::CANCELLED_BY_USER:
                $res = Yii::t('app', 'Отменено пользователем');
                break;
            case RecordStatus::ARCHIVE:
                $res = Yii::t('app', 'В архиве');
                break;
            case RecordStatus::DELETED:
                $res = Yii::t('app', 'Удалено');
                break;
            default:
                $res = Yii::t('app', 'Не определено');
        }

        return $res;
    }

    /**
     * Метод возвращает массив допустимых статусов для HTML-страниц
     */
    public static function getStatusListForHtmlPages() {
        $statusList = [
            RecordStatus::PUBLISHED => Yii::t('app', 'Опубликовано'),
            RecordStatus::DRAFT => Yii::t('app', 'Черновик'),
            RecordStatus::ARCHIVE => Yii::t('app', 'В архиве'),
        ];
        return $statusList;
    }
}