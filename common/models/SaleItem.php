<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sale_item".
 *
 * @property int $id
 * @property int $price_in
 * @property int $price_out
 * @property int $items
 * @property int $type_id
 * @property int $model_id
 * @property int $sale_id
 * @property string $updated_at
 *
 * @property BrandModel $model
 * @property Sale $sale
 * @property DeviceType $type
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
            [['price_in', 'price_out', 'items', 'type_id', 'model_id', 'sale_id'], 'required'],
            [['price_in', 'price_out', 'items', 'type_id', 'model_id', 'sale_id'], 'integer'],
            [['updated_at'], 'safe'],
            [['model_id'], 'exist', 'skipOnError' => true, 'targetClass' => BrandModel::className(), 'targetAttribute' => ['model_id' => 'id']],
            [['sale_id'], 'exist', 'skipOnError' => true, 'targetClass' => Sale::className(), 'targetAttribute' => ['sale_id' => 'id']],
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
            'price_in' => Yii::t('app', 'Price In'),
            'price_out' => Yii::t('app', 'Price Out'),
            'items' => Yii::t('app', 'Items'),
            'type_id' => Yii::t('app', 'Type ID'),
            'model_id' => Yii::t('app', 'Model ID'),
            'sale_id' => Yii::t('app', 'Sale ID'),
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
    public function getSale()
    {
        return $this->hasOne(Sale::className(), ['id' => 'sale_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(DeviceType::className(), ['id' => 'type_id']);
    }
}
