<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Stock;

/**
 * StockSearch represents the model behind the search form of `common\models\Stock`.
 */
class StockSearch extends Stock {

    public $deviceType;
    public $brandModel;
    
    public function rules() {
        return [
                [['price_in', 'price_out', 'first_discount', 'major_discount'], 'integer'],
                [['code', 'deviceType', 'brandModel', 'items'], 'safe'],
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
        $query = Stock::find();

        // add conditions that should always apply here

        $query->joinWith(['deviceType']);
        $query->joinWith(['brandModel']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['deviceType'] = [
            'asc' => ['device_type.name' => SORT_ASC],
            'desc' => ['device_type.name' => SORT_DESC],
        ];
        
        $dataProvider->sort->attributes['brandModel'] = [
            'asc' => ['brand_model.name' => SORT_ASC],
            'desc' => ['brand_model.name' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'stock.stock_type_id' => $this->stock_type_id,
            'price_in' => $this->price_in,
            'price_out' => $this->price_out,
            'first_discount' => $this->first_discount,
            'major_discount' => $this->major_discount,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
                ->andFilterWhere(['like', 'items', $this->items])
                ->andFilterWhere(['like', 'device_type.name', $this->deviceType])
                ->andFilterWhere(['like', 'brand_model.name', $this->brandModel]);

        return $dataProvider;
    }

}
