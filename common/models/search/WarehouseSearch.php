<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Warehouse;

/**
 * WarehouseSearch represents the model behind the search form of `common\models\Warehouse`.
 */
class WarehouseSearch extends Warehouse {

    public $type;
    public $model;

    public function rules() {
        return [
                [['price_in', 'price_out'], 'integer'],
                [['code', 'name', 'items', 'type', 'model'], 'safe'],
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
        $query = Warehouse::find();

        // add conditions that should always apply here

        $query->joinWith(['type']);
        $query->joinWith(['model']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['type'] = [
            'asc' => ['device_type.name' => SORT_ASC],
            'desc' => ['device_type.name' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['model'] = [
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
            'price_in' => $this->price_in,
            'price_out' => $this->price_out,
            'items' => $this->items,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
                ->andFilterWhere(['like', 'name', $this->name])
                ->andFilterWhere(['like', 'device_type.name', $this->type])
                ->andFilterWhere(['like', 'brand_model.name', $this->model]);

        return $dataProvider;
    }

}
