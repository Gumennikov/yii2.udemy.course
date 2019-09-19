<?php
namespace app\models\help;
// namespace tpu\common\helpers; Semenov

use Yii;

/**
 * Класс содержит методы для работы с датой
 */
class DateHelper
{
    // Количество секунд
    const YEAR = 31556926;
    const MONTH = 2629744;
    const WEEK = 604800;
    const DAY = 86400;
    const HOUR = 3600;
    const MINUTE = 60;

    public static $dateTimeOracle = 'Y-m-d H:i:s';   // $timestamp_format
    public static $dateOracle = 'Y-m-d';    // $date_format
    public static $timeOracle = 'H:i:s';    // $time_format

    /**
     * Вернуть текущую дату/время, установленное на сервере
     *
     * @return string
     */
    public static function now($timestamp = null)
    {
        if ($timestamp) {
            return date(self::$dateTimeOracle, $timestamp);
        } else {
            return date(self::$dateTimeOracle);
        }
    }

    /**
     * Вернуть текущую дату, установленное на сервере
     *
     * @return string
     */
    public static function date($timestamp = null)
    {
        if ($timestamp) {
            return date(self::$dateOracle, $timestamp);
        } else {
            return date(self::$dateOracle);
        }
    }

    /**
     * Перевод данных (даты) в формат БД Oracle
     *
     * $input: Дата в виде строки в формате => dd.mm.YYYY
     */
    public static function formatToOracle($input, $isDatetime = false, $convert = false)
    {
        if ($input) {
            /*
            if (is_array($input)) {
                $array = array_diff($input, array('', null, false));
                if (!$array) {
                    return null;
                }
                $input = self::fromArray($input);
            }
            */

            switch ((int)$isDatetime) {
                case 1:
                    $value = Yii::$app->formatter->asDatetime($input, 'php:' . self::$dateTimeOracle);
                    if ($convert) {
                        $value = "to_date('" . $value . "', 'YYYY-MM-DD HH24:MI:SS')";
                    }
                    break;
                case 0:
                    $value = Yii::$app->formatter->asDate($input, 'php:' . self::$dateOracle);
                    if ($convert) {
                        $value = "to_date('" . $value . "', 'YYYY-MM-DD')";
                    }
                    break;
                case -1:
                    $value = Yii::$app->formatter->asTime($input, 'php:' . self::$timeOracle);
                    if ($convert) {
                        $value = "to_date('" . $value . "', 'HH24:MI:SS')";
                    }
                    break;
            }

            //var_dump($value);
            return $value;
        }

        return null;
    }

    /**
     * Метод конвертирует дату в строку в формат => dd.mm.YYYY
     *
     * $dataInput: дата
     * $isDatetime: bool
     */
    public static function formatToRusString($dateInput, $isDatetime = false)
    {
        if ($dateInput) {
            if ($isDatetime) {
                return Yii::$app->formatter->asDatetime($dateInput, 'php:d.m.Y H:i:s');

            }
            else {
                return Yii::$app->formatter->asDate($dateInput, 'php:d.m.Y');
            }
        }

        return null;
    }

    /**
     * Метод добавляет секунды для указанной даны
     *
     * @return int
     */
    public static function addSeconds($dateTime, $seconds)
    {
        if (!is_numeric($dateTime)) {
            $dateTime = strtotime($dateTime);
        }

        return $dateTime + $seconds;
    }
}