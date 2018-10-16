<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "workshop".
 *
 * @property int $id
 * @property string $pre_diagnosis
 * @property string $password_pattern
 * @property string $observations
 * @property string $signature_in
 * @property string $signature_out
 * @property int $effort
 * @property int $receiver_id
 * @property int $type_id
 * @property int $model_id
 * @property string $updated_at
 *
 * @property BrandModel $model
 * @property User $receiver
 * @property DeviceType $type
 * @property WorkshopPayment[] $workshopPayments
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
            [['pre_diagnosis', 'type_id', 'model_id'], 'required'],
            [['effort', 'receiver_id', 'type_id', 'model_id'], 'integer'],
            [['updated_at'], 'safe'],
            [['pre_diagnosis', 'password_pattern'], 'string', 'max' => 250],
            [['observations'], 'string', 'max' => 500],
            [['signature_in', 'signature_out'], 'string', 'max' => 50],
            [['model_id'], 'exist', 'skipOnError' => true, 'targetClass' => BrandModel::className(), 'targetAttribute' => ['model_id' => 'id']],
            [['receiver_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['receiver_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => DeviceType::className(), 'targetAttribute' => ['type_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'pre_diagnosis' => Yii::t('app', 'Pre Diagnosis'),
            'password_pattern' => Yii::t('app', 'Password Pattern'),
            'observations' => Yii::t('app', 'Observations'),
            'signature_in' => Yii::t('app', 'Signature In'),
            'signature_out' => Yii::t('app', 'Signature Out'),
            'effort' => Yii::t('app', 'Effort'),
            'receiver_id' => Yii::t('app', 'Receiver ID'),
            'type_id' => Yii::t('app', 'Type ID'),
            'model_id' => Yii::t('app', 'Model ID'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModel()
    {
        return $this->hasOne(BrandModel::className(), ['id' => 'model_id']);
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
    public function getType()
    {
        return $this->hasOne(DeviceType::className(), ['id' => 'type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorkshopPayments()
    {
        return $this->hasMany(WorkshopPayment::className(), ['workshop_id' => 'id']);
    }
}
