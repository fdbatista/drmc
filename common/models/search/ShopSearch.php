<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Shop;

/**
 * ShopSearch represents the model behind the search form of `common\models\Shop`.
 */
class ShopSearch extends Shop {

    /**
     * {@inheritdoc}
     */
    
    public $device;
    
    public function rules() {
        return [
                [['device_id', 'price_in', 'price_out', 'first_discount', 'major_discount'], 'integer'],
                [['inventory', 'code', 'device', 'items'], 'safe'],
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
        $query = Shop::find();

        // add conditions that should always apply here

        $query->joinWith(['device']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['device'] = [
            'asc' => ['device.name' => SORT_ASC],
            'desc' => ['device.name' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'device_id' => $this->device_id,
            'price_in' => $this->price_in,
            'price_out' => $this->price_out,
            'first_discount' => $this->first_discount,
            'major_discount' => $this->major_discount,
        ]);

        $query->andFilterWhere(['like', 'inventory', $this->inventory])
                ->andFilterWhere(['like', 'code', $this->code])
                ->andFilterWhere(['like', 'device.name', $this->device]);

        return $dataProvider;
    }

}
