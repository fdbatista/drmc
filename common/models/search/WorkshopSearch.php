<?php

namespace common\models\search;

use common\models\Workshop;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * WorkshopSearch represents the model behind the search form of `common\models\Workshop`.
 */
class WorkshopSearch extends Workshop {

    public $deviceType;
    public $brandModel;

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
                [['effort', 'receiver_id'], 'integer'],
                [['deviceType', 'brandModel', 'password', 'folio_number', 'status', 'final_price'], 'safe'],
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
        $query = Workshop::find();

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
            'effort' => $this->effort,
            'receiver_id' => $this->receiver_id,
            'status' => $this->status,
            'branch_id' => $this->branch_id,
            'final_price' => $this->final_price,
        ]);

        $query->andFilterWhere(['like', 'password', $this->password])
                ->andFilterWhere(['like', 'folio_number', $this->folio_number])
                ->andFilterWhere(['like', 'signature_in', $this->signature_in])
                ->andFilterWhere(['like', 'signature_out', $this->signature_out])
                ->andFilterWhere(['like', 'device_type.name', $this->deviceType])
                ->andFilterWhere(['like', 'brand_model.name', $this->brandModel]);

        return $dataProvider;
    }

}
