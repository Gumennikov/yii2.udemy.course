<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CitationRecord;

/**
 * CitationSearch represents the model behind the search form of `app\models\CitationRecord`.
 */
class CitationSearch extends CitationRecord
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID', 'CITATION_STATUS', 'REC_STATUS'], 'integer'],
            [['AUTHOR_NAME', 'IZDANIE', 'TEXT', 'CREATED', 'CREATED_BY', 'UPDATED', 'UPDATED_BY'], 'safe'],
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
        $query = CitationRecord::find();

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
            'ID' => $this->ID,
            'CREATED' => $this->CREATED,
            'UPDATED' => $this->UPDATED,
            'CITATION_STATUS' => $this->CITATION_STATUS,
            'REC_STATUS' => $this->REC_STATUS,
        ]);

        $query->andFilterWhere(['like', 'AUTHOR_NAME', $this->AUTHOR_NAME])
            ->andFilterWhere(['like', 'IZDANIE', $this->IZDANIE])
            ->andFilterWhere(['like', 'TEXT', $this->TEXT])
            ->andFilterWhere(['like', 'CREATED_BY', $this->CREATED_BY])
            ->andFilterWhere(['like', 'UPDATED_BY', $this->UPDATED_BY]);

        return $dataProvider;
    }
}
