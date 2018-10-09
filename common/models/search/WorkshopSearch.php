<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Workshop;

/**
 * WorkshopSearch represents the model behind the search form of `common\models\Workshop`.
 */
class WorkshopSearch extends Workshop
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['device_id', 'effort', 'receiver_id'], 'integer'],
            [['pre_diagnosis', 'password_pattern', 'observations', 'signature_in', 'signature_out'], 'safe'],
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
        $query = Workshop::find();

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
            'device_id' => $this->device_id,
            'effort' => $this->effort,
            'receiver_id' => $this->receiver_id,
        ]);

        $query->andFilterWhere(['like', 'pre_diagnosis', $this->pre_diagnosis])
            ->andFilterWhere(['like', 'password_pattern', $this->password_pattern])
            ->andFilterWhere(['like', 'observations', $this->observations])
            ->andFilterWhere(['like', 'signature_in', $this->signature_in])
            ->andFilterWhere(['like', 'signature_out', $this->signature_out]);

        return $dataProvider;
    }
}
