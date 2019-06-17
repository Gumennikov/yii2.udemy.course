<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\BannerGallery;

/**
 * BannerGallerySearch represents the model behind the search form of `frontend\models\BannerGallery`.
 */
class BannerGallerySearch extends BannerGallery
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID', 'WIDTH', 'HEIGHT', 'REC_STATUS'], 'integer'],
            [['DESCRIPTION', 'CREATED', 'CREATED_BY', 'UPDATED', 'UPDATED_BY'], 'safe'],
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
        $query = BannerGallery::find();

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
            'WIDTH' => $this->WIDTH,
            'HEIGHT' => $this->HEIGHT,
            'CREATED' => $this->CREATED,
            'UPDATED' => $this->UPDATED,
            'REC_STATUS' => $this->REC_STATUS,
        ]);

        $query->andFilterWhere(['like', 'DESCRIPTION', $this->DESCRIPTION])
            ->andFilterWhere(['like', 'CREATED_BY', $this->CREATED_BY])
            ->andFilterWhere(['like', 'UPDATED_BY', $this->UPDATED_BY]);

        return $dataProvider;
    }
}
