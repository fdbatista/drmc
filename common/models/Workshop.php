<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "workshop".
 *
 * @property int $id
 * @property string $password
 * @property string $pattern
 * @property string $pattern_gif
 * @property string $observations
 * @property string $signature_in
 * @property string $signature_out
 * @property string $date_received
 * @property string $date_closed
 * @property string $warranty_until
 * @property string $updated_at
 * @property string $serial_number
 * @property string $customer_name
 * @property string $customer_telephone
 * @property string $folio_number
 * @property double $discount_applied
 * @property double $final_price
 * @property double $effort
 * @property int $status
 * @property int $receiver_id
 * @property int $device_type_id
 * @property int $brand_model_id
 *
 * @property BrandModel $brandModel
 * @property DeviceType $deviceType
 * @property User $receiver
 * @property WorkshopPayment[] $workshopPayments
 * @property WorkshopPreDiagnosis[] $workshopPreDiagnoses
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
            [['pattern_gif'], 'string'],
            [['date_received', 'serial_number', 'customer_name', 'customer_telephone', 'folio_number', 'effort', 'device_type_id', 'brand_model_id'], 'required'],
            [['date_received', 'date_closed', 'warranty_until', 'updated_at'], 'safe'],
            [['discount_applied', 'final_price', 'effort'], 'number'],
            [['status', 'receiver_id', 'device_type_id', 'brand_model_id'], 'integer'],
            [['password', 'signature_in', 'signature_out'], 'string', 'max' => 50],
            [['pattern', 'serial_number', 'customer_name', 'customer_telephone', 'folio_number'], 'string', 'max' => 255],
            [['observations'], 'string', 'max' => 500],
            [['folio_number'], 'unique'],
            [['brand_model_id'], 'exist', 'skipOnError' => true, 'targetClass' => BrandModel::className(), 'targetAttribute' => ['brand_model_id' => 'id']],
            [['device_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => DeviceType::className(), 'targetAttribute' => ['device_type_id' => 'id']],
            [['receiver_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['receiver_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'password' => Yii::t('app', 'Password'),
            'pattern' => Yii::t('app', 'Pattern'),
            'pattern_gif' => Yii::t('app', 'Pattern Gif'),
            'observations' => Yii::t('app', 'Observations'),
            'signature_in' => Yii::t('app', 'Signature In'),
            'signature_out' => Yii::t('app', 'Signature Out'),
            'date_received' => Yii::t('app', 'Date Received'),
            'date_closed' => Yii::t('app', 'Date Closed'),
            'warranty_until' => Yii::t('app', 'Warranty Until'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'serial_number' => Yii::t('app', 'Serial Number'),
            'customer_name' => Yii::t('app', 'Customer Name'),
            'customer_telephone' => Yii::t('app', 'Customer Telephone'),
            'folio_number' => Yii::t('app', 'Folio Number'),
            'discount_applied' => Yii::t('app', 'Discount Applied'),
            'final_price' => Yii::t('app', 'Final Price'),
            'effort' => Yii::t('app', 'Effort'),
            'status' => Yii::t('app', 'Status'),
            'receiver_id' => Yii::t('app', 'Receiver ID'),
            'device_type_id' => Yii::t('app', 'Device Type ID'),
            'brand_model_id' => Yii::t('app', 'Brand Model ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBrandModel()
    {
        return $this->hasOne(BrandModel::className(), ['id' => 'brand_model_id']);
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
    public function getReceiver()
    {
        return $this->hasOne(User::className(), ['id' => 'receiver_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorkshopPayments()
    {
        return $this->hasMany(WorkshopPayment::className(), ['workshop_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorkshopPreDiagnoses()
    {
        return $this->hasMany(WorkshopPreDiagnosis::className(), ['workshop_id' => 'id']);
    }
}
