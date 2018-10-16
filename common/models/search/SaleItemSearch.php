<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\SaleItem;

/**
 * SaleItemSearch represents the model behind the search form of `common\models\SaleItem`.
 */
class SaleItemSearch extends SaleItem {

    public $type;
    public $model;

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
                [['id', 'price_in', 'price_out', 'items', 'type_id', 'model_id', 'sale_id'], 'integer'],
                [['type', 'model', 'updated_at'], 'safe'],
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
        $query = SaleItem::find();

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
                    'id' => $this->id,
                    'price_in' => $this->price_in,
                    'price_out' => $this->price_out,
                    'items' => $this->items,
                    'type_id' => $this->type_id,
                    'model_id' => $this->model_id,
                    'sale_id' => $this->sale_id,
                    'updated_at' => $this->updated_at,
                ])
                ->andFilterWhere(['like', 'device_type.name', $this->type])
                ->andFilterWhere(['like', 'brand_model.name', $this->model]);

        return $dataProvider;
    }

}
