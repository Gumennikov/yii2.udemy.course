<?php
/**
 * Created by PhpStorm.
 * User: gumennikov
 * Date: 03.04.2019
 * Time: 9:48
 */
namespace frontend\models;

use Yii;

class Mailer {
    const TYPE_REGISTRATION = 1;
    const TYPE_PASSWORD_RESET = 2;

    private static $renderFile;
    private static $renderParams = [];
    private static $from = ['12345@yandex.ru' => 'Acme mailer'];
    private static $to;
    private static $subject;


    /**
     * @param $type
     * @param $model
     * @return bool
     */
    public static function validate($type, $model)
    {
        switch($type) {
            case self::TYPE_REGISTRATION:
                //other validations
                if (empty($model->id) || empty($model->uid) || empty($model->username) || empty($model->email)) {
                    return false;
                }
                self::$to = [$model->email];
                self::$subject = Yii::t('app', 'Please, activate your account');
                self::$renderFile = 'registration';
                self::$renderParams = ['user' => $model];

                break;

            case self::TYPE_PASSWORD_RESET:
                //Проверяем какие поля нужны из модели ($model->id, ...), определяем $to ... renderParams
                break;

            default:
                return false;
        }
        return true;
    }

    /**
     * Метод для отправки электронных писем
     * @param $type
     * @param $model
     * @return bool
     */
    public static function send($type, $model)
    {
        if (!self::validate($type, $model)) {
            return false;
        }
        //send emails
        $message = \Yii::$app->mailer->compose(self::$renderFile, self::$renderParams);
        return $message->setFrom(self::$from)->setTo(self::$to)->setSubject(self::$subject)->send();
    }
}