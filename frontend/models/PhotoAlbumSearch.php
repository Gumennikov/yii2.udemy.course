<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\PhotoAlbum;

/**
 * PhotoAlbumSearch represents the model behind the search form of `frontend\models\PhotoAlbum`.
 */
class PhotoAlbumSearch extends PhotoAlbum
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID', 'REC_STATUS', 'SITE_LANG_ID'], 'integer'],
            [['TITLE', 'CREATED', 'CREATED_BY', 'UPDATED', 'UPDATED_BY'], 'safe'],
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
        $query = PhotoAlbum::find();

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
            'REC_STATUS' => $this->REC_STATUS,
            'SITE_LANG_ID' => $this->SITE_LANG_ID,
        ]);

        $query->andFilterWhere(['like', 'TITLE', $this->TITLE])
            ->andFilterWhere(['like', 'CREATED_BY', $this->CREATED_BY])
            ->andFilterWhere(['like', 'UPDATED_BY', $this->UPDATED_BY]);

        return $dataProvider;
    }
}
