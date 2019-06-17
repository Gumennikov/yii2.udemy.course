<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Banner;

/**
 * BannerSearch represents the model behind the search form of `frontend\models\Banner`.
 */
class BannerSearch extends Banner
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID', 'BANNER_GALLERY_ID', 'REC_STATUS', 'TARGET_ID', 'PORYADOK'], 'integer'],
            [['TEXT', 'LINK_URL', 'FILE_URL', 'CREATED', 'CREATED_BY', 'UPDATED', 'UPDATED_BY'], 'safe'],
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
        $query = Banner::find();

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
            'BANNER_GALLERY_ID' => $this->BANNER_GALLERY_ID,
            'REC_STATUS' => $this->REC_STATUS,
            'TARGET_ID' => $this->TARGET_ID,
            'PORYADOK' => $this->PORYADOK,
            'CREATED' => $this->CREATED,
            'UPDATED' => $this->UPDATED,
        ]);

        $query->andFilterWhere(['like', 'TEXT', $this->TEXT])
            ->andFilterWhere(['like', 'LINK_URL', $this->LINK_URL])
            ->andFilterWhere(['like', 'FILE_URL', $this->FILE_URL])
            ->andFilterWhere(['like', 'CREATED_BY', $this->CREATED_BY])
            ->andFilterWhere(['like', 'UPDATED_BY', $this->UPDATED_BY]);

        return $dataProvider;
    }
}
