<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "v_sales_current_info".
 *
 * @property string $type
 * @property string $amount
 * @property double $profit
 */
class VSalesCurrentInfo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'v_sales_current_info';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['amount', 'profit'], 'number'],
            [['type'], 'string', 'max' => 5],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'type' => Yii::t('app', 'Type'),
            'amount' => Yii::t('app', 'Amount'),
            'profit' => Yii::t('app', 'Profit'),
        ];
    }
}
