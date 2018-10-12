<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Device;

/**
 * DeviceSearch represents the model behind the search form of `common\models\Device`.
 */
class DeviceSearch extends Device {

    /**
     * {@inheritdoc}
     */
    public $type;
    public $model;
    
    public function rules() {
        return [
                [['id', 'type_id', 'model_id'], 'integer'],
                [['type', 'model', 'model.getBrand'], 'safe'],
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
        $query = Device::find();
        
        $query->joinWith(['type']);
        $query->joinWith(['model']);
        $query->joinWith(['model.brand']);

        // add conditions that should always apply here

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
        
        $dataProvider->sort->attributes['model'] = [
            'asc' => ['model.brand.name' => SORT_ASC],
            'desc' => ['model.brand.name' => SORT_DESC],
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
            'type_id' => $this->type_id,
            'model_id' => $this->model_id,
        ]);
        
        $query->andFilterWhere(['like', 'brand_model.name', $this->model])
                ->andFilterWhere(['like', 'device_type.name', $this->type])
                ->andFilterWhere(['like', 'modelbrand.name', $this->type]);

        return $dataProvider;
    }

}
