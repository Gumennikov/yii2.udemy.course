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
    public $language;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'site_lang_id', 'rec_status'], 'integer'],
            [['content', 'created', 'created_by', 'updated',
                'updated_by', 'title', 'description', 'from_date', 'to_date', 'language'], 'safe'],
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
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'site_lang_id' => $this->site_lang_id,
            'created' => $this->created,
            'updated' => $this->updated,
            'rec_status' => $this->rec_status,
            //TODO фильтр по языкам страницы. Из связанной таблицы site_lang
        ]);

        $query->andFilterWhere(['like', 'content', $this->content])
            //->andFilterWhere(['like', 'language.language', $this->language])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
