<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\DeviceType;

/**
 * DeviceTypeSearch represents the model behind the search form of `common\models\DeviceType`.
 */
class DeviceTypeSearch extends DeviceType
{
    public $stockType;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'stockType', 'stock_type_id'], 'safe'],
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
        $query = DeviceType::find();
        
        $query->joinWith('stockType');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        $dataProvider->sort->attributes['stockType'] = [
            'asc' => ['stock_type.name' => SORT_ASC],
            'desc' => ['stock_type.name' => SORT_DESC],
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
            'stock_type_id' => $this->stock_type_id,
        ]);

        $query->andFilterWhere(['like', 'device_type.name', $this->name]);
        $query->andFilterWhere(['like', 'stock_type.name', $this->stockType]);

        return $dataProvider;
    }
}
