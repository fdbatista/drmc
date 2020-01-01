<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "workshop_pre_diagnosis".
 *
 * @property int $id
 * @property int $workshop_id
 * @property int $device_type_id
 * @property double $price_out
 * @property int $items
 * @property int $price_in
 *
 * @property DeviceType $deviceType
 * @property Workshop $workshop
 */
class WorkshopPreDiagnosis extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'workshop_pre_diagnosis';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['workshop_id', 'device_type_id', 'price_out', 'items'], 'required'],
            [['workshop_id', 'device_type_id', 'items', 'price_in'], 'integer'],
            [['price_out'], 'number'],
            [['device_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => DeviceType::className(), 'targetAttribute' => ['device_type_id' => 'id']],
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
            'workshop_id' => Yii::t('app', 'Workshop ID'),
            'device_type_id' => Yii::t('app', 'Device Type ID'),
            'price_out' => Yii::t('app', 'Price Out'),
            'items' => Yii::t('app', 'Items'),
            'price_in' => Yii::t('app', 'Price In'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeviceType()
    {
        return $this->hasOne(DeviceType::className(), ['id' => 'device_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorkshop()
    {
        return $this->hasOne(Workshop::className(), ['id' => 'workshop_id']);
    }
}
