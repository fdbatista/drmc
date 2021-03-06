<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Sale;

/**
 * SaleSearch represents the model behind the search form of `common\models\Sale`.
 */
class SaleSearch extends Sale {

    public $customer;

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
                [['id', 'customer_id'], 'integer'],
                [['date', 'updated_at', 'customer', 'status', 'serial_number', 'total_price'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios() {
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
    public function search($params) {
        $query = Sale::find();

        // add conditions that should always apply here

        $query->joinWith(['customer']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['customer'] = [
            'asc' => ['customer.code' => SORT_ASC],
            'desc' => ['customer.code' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'customer_id' => $this->customer_id,
            'updated_at' => $this->updated_at,
            'branch_id' => $this->branch_id,
        ]);
        
        $query->andFilterWhere(['like', 'customer.code', $this->customer])
                ->andFilterWhere(['like', 'serial_number', $this->serial_number])
                ->andFilterWhere(['like', 'total_price', $this->total_price]);

        if ($this->date) {
            $date = explode(' al ', $this->date);
            $query->andFilterWhere(['between', 'date', $date[0], $date[1]]);
        }
        return $dataProvider;
    }

}
