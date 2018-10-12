<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "shop".
 *
 * @property int $device_id
 * @property string $inventory
 * @property string $code
 * @property int $price_in
 * @property int $price_out
 * @property int $first_discount
 * @property int $major_discount
 * @property int $items
 *
 * @property Device $device
 */
class Shop extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shop';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['device_id', 'inventory', 'code', 'price_in', 'price_out', 'first_discount', 'major_discount', 'items'], 'required'],
            [['device_id', 'price_in', 'price_out', 'first_discount', 'major_discount', 'items'], 'integer'],
            [['inventory', 'code'], 'string', 'max' => 50],
            [['device_id'], 'unique'],
            [['device_id'], 'exist', 'skipOnError' => true, 'targetClass' => Device::className(), 'targetAttribute' => ['device_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'device_id' => Yii::t('app', 'Device ID'),
            'inventory' => Yii::t('app', 'Inventory'),
            'code' => Yii::t('app', 'Code'),
            'price_in' => Yii::t('app', 'Price In'),
            'price_out' => Yii::t('app', 'Price Out'),
            'first_discount' => Yii::t('app', 'First Discount'),
            'major_discount' => Yii::t('app', 'Major Discount'),
            'items' => Yii::t('app', 'Items'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDevice()
    {
        return $this->hasOne(Device::className(), ['id' => 'device_id']);
    }
}
