<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Page;

/**
 * PageSearch represents the model behind the search form of `frontend\models\Page`.
 */
class PageSearch extends Page
{
    public $languageName;
    public $parentName;
    public $parent_id;
    public $pageNameAndId;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'site_lang_id', 'rec_status', 'parent_id'], 'integer'],
            [['content', 'created', 'created_by', 'updated',
                'updated_by', 'title', 'description', 'from_date',
                'to_date', 'parent_id', 'languageName', 'pageNameAndId', 'parentName'], 'safe'],
            [['created', 'updated', 'parentName', 'pageNameAndId', 'languageName'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }
//
//    /**
//     * @param $query
//     * @param $attribute
//     * @param bool $partialMatch
//     */
//    protected function addCondition($query, $attribute, $partialMatch = false)
//    {
//        if (($pos = strrpos($attribute, '.')) !== false) {
//            $modelAttribute = substr($attribute, $pos + 1);
//        } else {
//            $modelAttribute = $attribute;
//        }
//
//        $value = $this->$modelAttribute;
//        if (trim($value) === '') {
//            return;
//        }
//
//        /*
//         * Для корректной работы фильтра со связью со
//         * своей же моделью:
//         */
//        $attribute = "page.$attribute";
//
//        if ($partialMatch) {
//            $query->andWhere(['like', $attribute, $value]);
//        } else {
//            $query->andWhere([$attribute => $value]);
//        }
//    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Page::find();
//        $query = Page::find()->joinWith('siteLang');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'forcePageParam' => false,
                'pageSizeParam' => false,
                'pageSize' => 20,
            ]
        ]);

        /**
         * Настройка параметров сортировки
         * Важно: должна быть выполнена раньше $this->load($params)
         */
        $dataProvider->setSort([
            'attributes' => [
                'id',
                'title',
                'created',
                'created_by',
                'rec_status',
                'parent_id',
                'parentName' => [
                    'asc' => ['parent.title' => SORT_ASC],
                    'desc' => ['parent.title' => SORT_DESC],
                    'label' => 'Родительская страница',
                    'default' => SORT_ASC
                ],
                'pageNameAndId' => [
                    'asc' => ['parent.title' => SORT_ASC],
                    'desc' => ['parent.title' => SORT_DESC],
                    'label' => 'Данные родителской страницы',
                    'default' => SORT_ASC
                ],
                'languageName' => [
                    'asc' => ['language.language' => SORT_ASC],
                    'desc' => ['language.language' => SORT_DESC],
                    'label' => 'Язык страницы',
                    'default' => SORT_ASC
                ],
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');

            // Жадная загрузка данных модели Языка для работы сортировки.
            //$query->joinWith(['language']);
            // Жадная загрузка данных модели Страны для работы сортировки.
            //$query->joinWith(['parent']);
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'page.id' => $this->id,
            'page.site_lang_id' => $this->site_lang_id,
            'page.created' => $this->created,
            'page.updated' => $this->updated,
            'page.rec_status' => $this->rec_status,
            'page.parent_id' => $this->parent_id,
            //TODO фильтр по языкам страницы. Из связанной таблицы site_lang
        ]);

        /* Правила фильтрации */

        $query->andFilterWhere(['like', 'page.content', $this->content])
            ->andFilterWhere(['like', 'page.created_by', $this->created_by])
            ->andFilterWhere(['like', 'page.updated_by', $this->updated_by])
            ->andFilterWhere(['like', 'page.title', $this->title])
            ->andFilterWhere(['like', 'page.description', $this->description])
            ->andFilterWhere(['like', 'page.parent_id', $this->parent_id])
//            ->andFilterWhere(['like', 'language.language', $this->languageName])

            // фильтр по языку
            ->joinWith(['language' => function ($q) {
                $q->where('language.language LIKE "%' . $this->languageName . '%"');
            }])

            // Фильтр по названию родительской страницы (поле Родительская страница)
            ->joinWith('parent')
            ->andFilterWhere(['like', 'parent.title', $this->parentName]);

            // Фильтр по названию родительской страницы (поле Родительская страница)
//            ->joinWith(['parent' => function ($q) {
//                $q->where('parent.title LIKE "%' . $this->parentName . '%"');
//            }]);

            // фильтр по названию родительской страницы (совмещенное поле Данные родителской страницы)
            // todo работает криво. Пересмотреть. Для фильтрации полей лучше использовать ->andFilterWhere,
            // todo т.к. вариант с ->joinWith может быть уязвим для инъекций
            //->andFilterWhere(['like', 'title', $this->pageNameAndId]);

        return $dataProvider;
    }
}
