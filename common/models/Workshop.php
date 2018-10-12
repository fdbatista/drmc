<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "workshop".
 *
 * @property int $device_id
 * @property string $pre_diagnosis
 * @property string $password_pattern
 * @property string $observations
 * @property string $signature_in
 * @property string $signature_out
 * @property int $effort
 * @property int $receiver_id
 *
 * @property Device $device
 * @property User $receiver
 */
class Workshop extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'workshop';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['device_id', 'pre_diagnosis'], 'required'],
            [['device_id', 'effort', 'receiver_id'], 'integer'],
            [['pre_diagnosis', 'password_pattern'], 'string', 'max' => 250],
            [['observations'], 'string', 'max' => 500],
            [['signature_in', 'signature_out'], 'string', 'max' => 50],
            [['device_id'], 'unique'],
            [['device_id'], 'exist', 'skipOnError' => true, 'targetClass' => Device::className(), 'targetAttribute' => ['device_id' => 'id']],
            [['receiver_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['receiver_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'device_id' => Yii::t('app', 'Device ID'),
            'pre_diagnosis' => Yii::t('app', 'Pre Diagnosis'),
            'password_pattern' => Yii::t('app', 'Password Pattern'),
            'observations' => Yii::t('app', 'Observations'),
            'signature_in' => Yii::t('app', 'Signature In'),
            'signature_out' => Yii::t('app', 'Signature Out'),
            'effort' => Yii::t('app', 'Effort'),
            'receiver_id' => Yii::t('app', 'Receiver ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDevice()
    {
        return $this->hasOne(Device::className(), ['id' => 'device_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReceiver()
    {
        return $this->hasOne(User::className(), ['id' => 'receiver_id']);
    }
}
