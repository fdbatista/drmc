<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "workshop_payment".
 *
 * @property int $id
 * @property int $device_id
 * @property double $amount
 * @property string $date
 */
class WorkshopPayment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'workshop_payment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['device_id', 'amount', 'date'], 'required'],
            [['device_id'], 'integer'],
            [['amount'], 'number'],
            [['date'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'device_id' => Yii::t('app', 'Device ID'),
            'amount' => Yii::t('app', 'Amount'),
            'date' => Yii::t('app', 'Date'),
        ];
    }
}
