<?php

namespace frontend\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

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
 * @property int $parent_id
 * @property int $ip_address
 *
 * @property SiteLang $id0
 * @property PageTag[] $pageTags
 */
class Page extends ActiveRecord
{
    //Переменная для хранения тэгов
    public $tags_array;
    //Переменная для хранения файла (картинки)
    public $file;

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
            [['id', 'site_lang_id', 'rec_status', 'parent_id'], 'integer'],
            [['content', 'ip_address'], 'string'],
            [['created', 'updated', 'ip_address'], 'safe'],
            [['created_by', 'updated_by', 'title', 'description'], 'string', 'max' => 45],
            [['id'], 'unique'],
            //[['id'], 'exist', 'skipOnError' => true, 'targetClass' => SiteLang::className(), 'targetAttribute' => ['id' => 'id']],
            [['tags_array'], 'safe'],
            [['file'], 'image'],
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
            'file' => 'Файл катринки',
            'parent_id' => 'ID родителя',
            'parentName' => 'Родительская страница',
            'pageNameAndId' => 'Данные родителской страницы',
            'ip_address' => 'IP-адрес',
        ];
    }

//    /**
//     * @return \yii\db\ActiveQuery
//     */
//    public function getId0()
//    {
//        return $this->hasOne(SiteLang::className(), ['id' => 'id']);
//    }

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

    /**
     * Метод для связи модели Page с моделью Language
     * @return \yii\db\ActiveQuery
     */
    public function getLanguage()
    {
        return $this->hasOne(Language::class, ['id' => 'language_id'])
            ->via('siteLang');
    }

    /**
     * Метод для получения названия языка
     * @return mixed
     */
    public function getLanguageName() {
        return $this->language->language;
    }

    /**
     * Метод для получения записи ActiveQuery родительской страницы
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Page::className(), ['id' => 'parent_id'])->from(self::tableName() . ' AS parent');
    }


    public function getParents($parentId, &$parents)
    {
        if ($parentId != 0) {
            while ($parentId != null)
            {
                $params = [':parent_id' => $parentId];
                $res = Yii::$app->db->createCommand('SELECT parent_id, title, alias FROM page WHERE id=:parent_id')
                    ->bindValues($params)
                    ->queryOne();
                $parentId = $res['parent_id'];
                $parents[] = $res;
//                var_dump($res);
            }

//            var_dump($parents);
//            if ($res['id'] != 0) {
////                getParents($res['id'], $parents);
//                $parentId = $res['id'];
//                $parents[] = $res['id'];
//            }
        } else {
            print_r('Нет родительских элементов');
        }
//        if ($parentId != 0) {
//            $params = [':parent_id' => $parentId];
//            $res = Yii::$app->db->createCommand('select parent_id from page where id =:parent_id')
//                ->bindValues($params)
//                ->queryOne();
////            var_dump($res['id']);
//            var_dump($res);
//        } else { print_r('Нет родительских элементов'); }
    }

    /**
     * Метод для получения имени родительской страницы
     * @return mixed
     */
    public function getParentName() {
        return $this->parent->title;
    }

    /**
     * Получение для получения записей ActiveQuery всех дочерних страниц
     * @return \yii\db\ActiveQuery
     */
    public function getChildren()
    {
        return $this->hasMany(Page::className(), ['parent_id' => 'id']);
    }

    /**
     * Метод для получения имен дочерних страниц
     * @return mixed
     */
    public function getChildrenName($id) {
//        return $this->children->title;
        return Page::find()->where(['parent_id' => $id])->orderBy('id')->asArray()->all();
    }

    /**
     * Возвращает Заголовок родительской страницы в формате: "Название страницы (id = 1)" или null,
     * если родителельской страницы нет
     * @return string|null
     */
    public function getPageNameAndId() {
        if ($this->parent_id !== null) {
            return $this->parent->title . ' (id = ' . $this->parent_id . ')';
        } else {
            return null;
        }
    }
}
