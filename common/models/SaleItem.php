<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sale_item".
 *
 * @property int $id
 * @property double $price_in
 * @property double $price_out
 * @property int $items
 * @property double $discount_applied
 * @property double $final_price
 * @property int $device_type_id
 * @property int $brand_model_id
 * @property int $sale_id
 * @property string $updated_at
 *
 * @property BrandModel $brandModel
 * @property DeviceType $deviceType
 * @property Sale $sale
 */
class SaleItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sale_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['price_in', 'price_out', 'items', 'device_type_id', 'brand_model_id', 'sale_id'], 'required'],
            [['price_in', 'price_out', 'discount_applied', 'final_price'], 'number'],
            [['items', 'device_type_id', 'brand_model_id', 'sale_id'], 'integer'],
            [['updated_at'], 'safe'],
            [['device_type_id', 'brand_model_id', 'sale_id'], 'unique', 'targetAttribute' => ['device_type_id', 'brand_model_id', 'sale_id']],
            [['brand_model_id'], 'exist', 'skipOnError' => true, 'targetClass' => BrandModel::className(), 'targetAttribute' => ['brand_model_id' => 'id']],
            [['device_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => DeviceType::className(), 'targetAttribute' => ['device_type_id' => 'id']],
            [['sale_id'], 'exist', 'skipOnError' => true, 'targetClass' => Sale::className(), 'targetAttribute' => ['sale_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'price_in' => 'Price In',
            'price_out' => 'Price Out',
            'items' => 'Items',
            'discount_applied' => 'Discount Applied',
            'final_price' => 'Final Price',
            'device_type_id' => 'Device Type ID',
            'brand_model_id' => 'Brand Model ID',
            'sale_id' => 'Sale ID',
            'updated_at' => 'Updated At',
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
    public function getSale()
    {
        return $this->hasOne(Sale::className(), ['id' => 'sale_id']);
    }
}
