<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\CleaningOrder;

/**
 * CleaningOrderSearch represents the model behind the search form of `frontend\models\CleaningOrder`.
 */
class CleaningOrderSearch extends CleaningOrder
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'cleaning_id', 'customer_profile_id'], 'integer'],
            [['code', 'name', 'address', 'phone_number', 'note', 'start_at', 'created_at', 'updated_at'], 'safe'],
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
        $query = CleaningOrder::find();

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
            'cleaning_id' => $this->cleaning_id,
            'start_at' => $this->start_at,
            'customer_profile_id' => $this->customer_profile_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'phone_number', $this->phone_number])
            ->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }
}
