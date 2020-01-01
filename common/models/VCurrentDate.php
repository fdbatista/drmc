<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "v_current_date".
 *
 * @property string $day
 * @property string $week
 * @property string $month
 * @property int $year
 */
class VCurrentDate extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'v_current_date';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['day'], 'safe'],
            [['year'], 'integer'],
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
        ];
    }
}
