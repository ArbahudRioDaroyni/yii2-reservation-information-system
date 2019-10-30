<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Payment;

/**
 * PaymentSearch represents the model behind the search form of `frontend\models\Payment`.
 */
class PaymentSearch extends Payment
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'tax', 'total_price', 'down_payment', 'amount_due', 'payment_method', 'status', 'order_id', 'list_type_order_id', 'total_payment'], 'integer'],
            [['invoice', 'date_of_issued', 'date_due', 'created_at', 'updated_at'], 'safe'],
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
        $query = Payment::find();

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
            'date_of_issued' => $this->date_of_issued,
            'date_due' => $this->date_due,
            'tax' => $this->tax,
            'total_price' => $this->total_price,
            'down_payment' => $this->down_payment,
            'amount_due' => $this->amount_due,
            'total_payment' => $this->total_payment,
            'payment_method' => $this->payment_method,
            'status' => $this->status,
            'order_id' => $this->order_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'invoice', $this->invoice]);

        return $dataProvider;
    }
}
