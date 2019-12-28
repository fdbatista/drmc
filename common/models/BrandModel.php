<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "brand_model".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $brand_id
 *
 * @property Brand $brand
 * @property SaleItem[] $saleItems
 * @property Stock[] $stocks
 * @property Workshop[] $workshops
 */
class BrandModel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'brand_model';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'brand_id'], 'required'],
            [['brand_id'], 'integer'],
            [['name'], 'string', 'max' => 75],
            [['description'], 'string', 'max' => 250],
            [['name'], 'unique'],
            [['brand_id'], 'exist', 'skipOnError' => true, 'targetClass' => Brand::className(), 'targetAttribute' => ['brand_id' => 'id']],
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
            'description' => Yii::t('app', 'Description'),
            'brand_id' => Yii::t('app', 'Brand ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBrand()
    {
        return $this->hasOne(Brand::className(), ['id' => 'brand_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaleItems()
    {
        return $this->hasMany(SaleItem::className(), ['brand_model_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStocks()
    {
        return $this->hasMany(Stock::className(), ['brand_model_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorkshops()
    {
        return $this->hasMany(Workshop::className(), ['brand_model_id' => 'id']);
    }
}
