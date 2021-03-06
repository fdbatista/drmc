<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "v_workshop_daily_amounts".
 *
 * @property int $branch_id
 * @property string $day
 * @property string $week
 * @property string $month
 * @property int $year
 * @property double $amount
 * @property double $profit
 */
class VWorkshopDailyAmounts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'v_workshop_daily_amounts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['branch_id'], 'required'],
            [['branch_id', 'year'], 'integer'],
            [['day'], 'safe'],
            [['amount', 'profit'], 'number'],
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
            'branch_id' => Yii::t('app', 'Branch ID'),
            'day' => Yii::t('app', 'Day'),
            'week' => Yii::t('app', 'Week'),
            'month' => Yii::t('app', 'Month'),
            'year' => Yii::t('app', 'Year'),
            'amount' => Yii::t('app', 'Amount'),
            'profit' => Yii::t('app', 'Profit'),
        ];
    }
}
