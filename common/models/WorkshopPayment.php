<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "workshop_payment".
 *
 * @property int $id
 * @property double $amount
 * @property string $date
 * @property int $workshop_id
 * @property string $updated_at
 *
 * @property Workshop $workshop
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
            [['amount', 'date', 'workshop_id'], 'required'],
            [['amount'], 'number'],
            [['date', 'updated_at'], 'safe'],
            [['workshop_id'], 'integer'],
            [['workshop_id'], 'exist', 'skipOnError' => true, 'targetClass' => Workshop::className(), 'targetAttribute' => ['workshop_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'amount' => 'Amount',
            'date' => 'Date',
            'workshop_id' => 'Workshop ID',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorkshop()
    {
        return $this->hasOne(Workshop::className(), ['id' => 'workshop_id']);
    }
}
