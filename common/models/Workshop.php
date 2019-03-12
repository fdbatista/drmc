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
 * @property int $branch_id
 *
 * @property Branch $branch
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
            [['pattern_gif', 'signature_in', 'signature_out'], 'string'],
            [['date_received', 'serial_number', 'customer_name', 'customer_telephone', 'folio_number', 'effort', 'device_type_id', 'brand_model_id', 'branch_id'], 'required'],
            [['date_received', 'date_closed', 'warranty_until', 'updated_at'], 'safe'],
            [['discount_applied', 'final_price', 'effort'], 'number'],
            [['status', 'receiver_id', 'device_type_id', 'brand_model_id', 'branch_id'], 'integer'],
            [['password'], 'string', 'max' => 50],
            [['pattern', 'serial_number', 'customer_name', 'customer_telephone', 'folio_number'], 'string', 'max' => 255],
            [['observations'], 'string', 'max' => 500],
            [['folio_number'], 'unique'],
            [['branch_id'], 'exist', 'skipOnError' => true, 'targetClass' => Branch::className(), 'targetAttribute' => ['branch_id' => 'id']],
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
            'id' => 'ID',
            'password' => 'Password',
            'pattern' => 'Pattern',
            'pattern_gif' => 'Pattern Gif',
            'observations' => 'Observations',
            'signature_in' => 'Signature In',
            'signature_out' => 'Signature Out',
            'date_received' => 'Date Received',
            'date_closed' => 'Date Closed',
            'warranty_until' => 'Warranty Until',
            'updated_at' => 'Updated At',
            'serial_number' => 'Serial Number',
            'customer_name' => 'Customer Name',
            'customer_telephone' => 'Customer Telephone',
            'folio_number' => 'Folio Number',
            'discount_applied' => 'Discount Applied',
            'final_price' => 'Final Price',
            'effort' => 'Effort',
            'status' => 'Status',
            'receiver_id' => 'Receiver ID',
            'device_type_id' => 'Device Type ID',
            'brand_model_id' => 'Brand Model ID',
            'branch_id' => 'Branch ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBranch()
    {
        return $this->hasOne(Branch::className(), ['id' => 'branch_id']);
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
