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
    public $start_date;
    public $end_date;

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
                [['id'], 'integer'],
                [['date', 'start_date', 'end_date', 'updated_at', 'customer'], 'safe'],
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
            'asc' => ['user.first_name' => SORT_ASC],
            'desc' => ['user.last_name' => SORT_DESC],
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
            'date' => $this->date,
            'updated_at' => $this->updated_at,
        ]);
        $query->andFilterWhere(['between', 'date', $this->start_date, $this->end_date]);

        $query->andFilterWhere(['like', "concat(user.first_name, ' ', user.last_name)", $this->customer]);

        return $dataProvider;
    }

}
