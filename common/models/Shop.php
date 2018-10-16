<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "shop".
 *
 * @property int $id
 * @property string $inventory
 * @property string $code
 * @property int $items
 * @property int $price_in
 * @property int $price_out
 * @property int $first_discount
 * @property int $major_discount
 * @property int $type_id
 * @property int $model_id
 * @property string $updated_at
 *
 * @property BrandModel $model
 * @property DeviceType $type
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
            [['inventory', 'code', 'items', 'price_in', 'price_out', 'first_discount', 'major_discount', 'type_id', 'model_id'], 'required'],
            [['items', 'price_in', 'price_out', 'first_discount', 'major_discount', 'type_id', 'model_id'], 'integer'],
            [['updated_at'], 'safe'],
            [['inventory', 'code'], 'string', 'max' => 50],
            [['model_id'], 'exist', 'skipOnError' => true, 'targetClass' => BrandModel::className(), 'targetAttribute' => ['model_id' => 'id']],
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
            'inventory' => Yii::t('app', 'Inventory'),
            'code' => Yii::t('app', 'Code'),
            'items' => Yii::t('app', 'Items'),
            'price_in' => Yii::t('app', 'Price In'),
            'price_out' => Yii::t('app', 'Price Out'),
            'first_discount' => Yii::t('app', 'First Discount'),
            'major_discount' => Yii::t('app', 'Major Discount'),
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
    public function getType()
    {
        return $this->hasOne(DeviceType::className(), ['id' => 'type_id']);
    }
}
