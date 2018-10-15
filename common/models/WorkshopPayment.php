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
            [['date'], 'safe'],
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
            'id' => Yii::t('app', 'ID'),
            'amount' => Yii::t('app', 'Amount'),
            'date' => Yii::t('app', 'Date'),
            'workshop_id' => Yii::t('app', 'Workshop ID'),
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
