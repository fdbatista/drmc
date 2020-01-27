<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "v_workshop_grouped_amounts".
 *
 * @property int $branch_id
 * @property string $type
 * @property string $value
 * @property double $amount
 * @property double $profit
 */
class VWorkshopGroupedAmounts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'v_workshop_grouped_amounts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['branch_id'], 'integer'],
            [['amount', 'profit'], 'number'],
            [['type'], 'string', 'max' => 5],
            [['value'], 'string', 'max' => 69],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'branch_id' => Yii::t('app', 'Branch ID'),
            'type' => Yii::t('app', 'Type'),
            'value' => Yii::t('app', 'Value'),
            'amount' => Yii::t('app', 'Amount'),
            'profit' => Yii::t('app', 'Profit'),
        ];
    }
}
