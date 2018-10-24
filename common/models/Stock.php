<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "stock".
 *
 * @property int $id
 * @property string $code
 * @property int $items
 * @property double $price_in
 * @property double $price_out
 * @property double $first_discount
 * @property double $major_discount
 * @property int $stock_type_id
 * @property int $device_type_id
 * @property int $brand_model_id
 * @property string $updated_at
 *
 * @property BrandModel $brandModel
 * @property DeviceType $deviceType
 * @property StockType $stockType
 */
class Stock extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'stock';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'items', 'price_in', 'price_out', 'first_discount', 'major_discount', 'stock_type_id', 'device_type_id', 'brand_model_id'], 'required'],
            [['items', 'stock_type_id', 'device_type_id', 'brand_model_id'], 'integer'],
            [['price_in', 'price_out', 'first_discount', 'major_discount'], 'number'],
            [['updated_at'], 'safe'],
            [['code'], 'string', 'max' => 50],
            [['code', 'stock_type_id'], 'unique', 'targetAttribute' => ['code', 'stock_type_id']],
            [['device_type_id', 'brand_model_id'], 'unique', 'targetAttribute' => ['device_type_id', 'brand_model_id']],
            [['brand_model_id'], 'exist', 'skipOnError' => true, 'targetClass' => BrandModel::className(), 'targetAttribute' => ['brand_model_id' => 'id']],
            [['device_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => DeviceType::className(), 'targetAttribute' => ['device_type_id' => 'id']],
            [['stock_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => StockType::className(), 'targetAttribute' => ['stock_type_id' => 'id']],
            ['price_out', 'compare', 'compareAttribute' => 'price_in', 'operator' => '>', 'type' => 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'code' => Yii::t('app', 'Code'),
            'items' => Yii::t('app', 'Items'),
            'price_in' => Yii::t('app', 'Price In'),
            'price_out' => Yii::t('app', 'Price Out'),
            'first_discount' => Yii::t('app', 'First Discount'),
            'major_discount' => Yii::t('app', 'Major Discount'),
            'stock_type_id' => Yii::t('app', 'Stock Type ID'),
            'device_type_id' => Yii::t('app', 'Device Type ID'),
            'brand_model_id' => Yii::t('app', 'Brand Model ID'),
            'updated_at' => Yii::t('app', 'Updated At'),
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
    public function getStockType()
    {
        return $this->hasOne(StockType::className(), ['id' => 'stock_type_id']);
    }
}
