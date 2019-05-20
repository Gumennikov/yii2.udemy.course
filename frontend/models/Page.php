<?php

namespace frontend\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "page".
 *
 * @property int $id
 * @property int $site_lang_id
 * @property string $content
 * @property string $created
 * @property string $created_by
 * @property string $updated
 * @property string $updated_by
 * @property string $title
 * @property string $description
 * @property int $rec_status
 *
 * @property SiteLang $id0
 * @property PageTag[] $pageTags
 */
class Page extends ActiveRecord
{
    //Переменная для хранения тэгов
    public $tags_array;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'page';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['site_lang_id'], 'required'],
            [['site_lang_id', 'rec_status'], 'integer'],
            [['content'], 'string'],
            [['created', 'updated'], 'safe'],
            [['created_by', 'updated_by', 'title', 'description'], 'string', 'max' => 45],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => SiteLang::className(), 'targetAttribute' => ['id' => 'id']],
            [['tags_array'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'site_lang_id' => 'Site Lang ID',
            'content' => 'Content',
            'created' => 'Created',
            'created_by' => 'Created By',
            'updated' => 'Updated',
            'updated_by' => 'Updated By',
            'title' => 'Title',
            'description' => 'Description',
            'rec_status' => 'Rec Status',
            'tags_array' => 'Тэги',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getId0()
    {
        return $this->hasOne(SiteLang::className(), ['id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPageTags()
    {
        return $this->hasMany(PageTag::className(), ['page_id' => 'id']);
    }

    /**
     *
     */
    public function afterFind()
    {
        $this->tags_array = $this->pageTags;
    }

//    public function afterSave($insert, $changedAttributes)
//    {
//        parent::afterSave($insert, $changedAttributes);
//
//        $arr = $this->pageTags;
//        foreach ($this->tags_array as $one) {
//            if (!in_array($one, $arr)) {
//                $model = new PageTag();
//                $model->page_id = $this->id;
//                $model->tag_id = $one;
//                $model->save();
//            }
//        }
//    }

    /**
     * @return array
     */
    public static function getRecStatusList()
    {
        return [1 => 'Опубликовано', 2 => 'Черновик'];
    }

    /**
     * @return mixed
     */
    public function getRecStatusName()
    {
        $list = self::getRecStatusList();
        return $list[$this->rec_status];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSiteLang()
    {
        return $this->hasOne(SiteLang::class, ['id' => 'site_lang_id']);
    }
}
