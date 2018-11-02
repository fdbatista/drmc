<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "device_type".
 *
 * @property int $id
 * @property string $name
 * @property int $stock_type_id
 *
 * @property StockType $stockType
 * @property SaleItem[] $saleItems
 * @property Stock[] $stocks
 * @property BrandModel[] $brandModels
 * @property Workshop[] $workshops
 * @property WorkshopPreDiagnosis[] $workshopPreDiagnoses
 */
class DeviceType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'device_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'stock_type_id'], 'required'],
            [['stock_type_id'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['name'], 'unique'],
            [['stock_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => StockType::className(), 'targetAttribute' => ['stock_type_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'stock_type_id' => Yii::t('app', 'Stock Type ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockType()
    {
        return $this->hasOne(StockType::className(), ['id' => 'stock_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaleItems()
    {
        return $this->hasMany(SaleItem::className(), ['device_type_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStocks()
    {
        return $this->hasMany(Stock::className(), ['device_type_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBrandModels()
    {
        return $this->hasMany(BrandModel::className(), ['id' => 'brand_model_id'])->viaTable('stock', ['device_type_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorkshops()
    {
        return $this->hasMany(Workshop::className(), ['device_type_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorkshopPreDiagnoses()
    {
        return $this->hasMany(WorkshopPreDiagnosis::className(), ['device_type_id' => 'id']);
    }
}
