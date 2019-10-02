<?php

namespace common\modules\commentary\models;

use Yii;
use yii\data\ActiveDataProvider;
use frontend\models\Page;

/**
 * This is the model class for table "comment".
 *
 * @property int $id
 * @property string $entity
 * @property int $entityId
 * @property string $content
 * @property int $parentId
 * @property int $level
 * @property int $createdBy
 * @property int $updatedBy
 * @property string $relatedTo
 * @property string $url
 * @property int $status
 * @property int $createdAt
 * @property int $updatedAt
 * @property int $email
 */
class Comment extends \yii\db\ActiveRecord
{
    public $verifyCode;
    public $reCaptcha;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['content'], 'required', 'on' => 'Guest'],
            //[['verifyCode'], 'captcha', 'on' => 'Guest'],
            //[['verifyCode'], 'safe'],
            [['reCaptcha'], \himiklab\yii2\recaptcha\ReCaptchaValidator3::className(),
                'threshold' => 0.5,
                'action' => 'view',
            ],
//            [['reCaptcha'], \himiklab\yii2\recaptcha\ReCaptchaValidator2::className(),
//                'uncheckedMessage' => 'Пожалуйста, подтвердите, что Вы не бот.'],
            [['content', 'createdBy', 'email'], 'required'],
            //[['entity', 'entityId', 'content', 'createdBy', 'updatedBy', 'relatedTo', 'createdAt', 'updatedAt', 'captcha'], 'required'],
            [['entityId', 'parentId', 'level', 'updatedBy', 'status', 'createdAt', 'updatedAt'], 'integer'],
            [['content', 'url', 'createdBy', 'email'], 'string'],
            [['email'], 'email'],
            [['entity'], 'string', 'max' => 10],
            [['relatedTo'], 'string', 'max' => 500],
            [['createdBy'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'entity' => Yii::t('app', 'Entity'),
            'entityId' => Yii::t('app', 'Entity ID'),
            'content' => Yii::t('app', 'Комментарий'),
            'parentId' => Yii::t('app', 'Parent ID'),
            'level' => Yii::t('app', 'Level'),
            'createdBy' => Yii::t('app', 'Кем создан'),
            'updatedBy' => Yii::t('app', 'Updated By'),
            'relatedTo' => Yii::t('app', 'Related To'),
            'url' => Yii::t('app', 'Url'),
            'status' => Yii::t('app', 'Status'),
            'createdAt' => Yii::t('app', 'Created At'),
            'updatedAt' => Yii::t('app', 'Updated At'),
            'verifyCode' => Yii::t('app', 'Подтвердите код'),
            'reCaptcha' => Yii::t('app', 'Google reCaptcha'),
            'email' => Yii::t('app', 'Электронная почта'),
        ];
    }

    /**
     * Метод возвращает время отправки комментария для нового комментария
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        if ($this->isNewRecord) {
            $this->createdAt = time();
        }

        return parent::beforeSave($insert);
    }

    public static function all($entityId)
    {
        $query = Comment::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'forcePageParam' => false,
                'pageSizeParam' => false,
                'pageSize' => 20,
            ]
        ]);

        // grid filtering conditions
        $query->andFilterWhere([
            'entityId' => $entityId,
            'status' => 2,
        ]);

        $query->orderBy(['createdAt' => SORT_DESC]);

        return $dataProvider;
    }
}
