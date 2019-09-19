<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\FileStorage;

/**
 * FileStorageSearch represents the model behind the search form of `frontend\models\FileStorage`.
 */
class FileStorageSearch extends FileStorage
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'rec_status', 'site_lang_id', 'fsize', 'is_image', 'tip_dostupa_id'], 'integer'],
            [['file_url', 'created', 'created_by', 'updated', 'updated_by', 'ftype', 'origin'], 'safe'],
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
        $query = FileStorage::find();

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
            'created' => $this->created,
            'updated' => $this->updated,
            'rec_status' => $this->rec_status,
            'site_lang_id' => $this->site_lang_id,
            'fsize' => $this->fsize,
            'is_image' => $this->is_image,
            'tip_dostupa_id' => $this->tip_dostupa_id,
        ]);

        $query->andFilterWhere(['like', 'file_url', $this->file_url])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by])
            ->andFilterWhere(['like', 'ftype', $this->ftype])
            ->andFilterWhere(['like', 'origin', $this->origin]);

        return $dataProvider;
    }
}
