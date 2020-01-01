<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "v_sales_daily_amounts".
 *
 * @property string $day
 * @property string $week
 * @property string $month
 * @property int $year
 * @property int $amount
 * @property double $profit
 */
class VSalesDailyAmounts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'v_sales_daily_amounts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['day'], 'safe'],
            [['year', 'amount'], 'integer'],
            [['profit'], 'number'],
            [['week'], 'string', 'max' => 7],
            [['month'], 'string', 'max' => 69],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'day' => Yii::t('app', 'Day'),
            'week' => Yii::t('app', 'Week'),
            'month' => Yii::t('app', 'Month'),
            'year' => Yii::t('app', 'Year'),
            'amount' => Yii::t('app', 'Amount'),
            'profit' => Yii::t('app', 'Profit'),
        ];
    }
}
