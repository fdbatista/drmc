<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "warehouse".
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property int $price_in
 * @property int $price_public
 * @property int $items
 * @property int $type_id
 * @property int $model_id
 * @property string $updated_at
 *
 * @property BrandModel $model
 * @property DeviceType $type
 */
class Warehouse extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'warehouse';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'name', 'price_in', 'price_public', 'items', 'type_id', 'model_id'], 'required'],
            [['price_in', 'price_public', 'items', 'type_id', 'model_id'], 'integer'],
            [['updated_at'], 'safe'],
            [['code', 'name'], 'string', 'max' => 50],
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
            'code' => Yii::t('app', 'Code'),
            'name' => Yii::t('app', 'Name'),
            'price_in' => Yii::t('app', 'Price In'),
            'price_public' => Yii::t('app', 'Price Public'),
            'items' => Yii::t('app', 'Items'),
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
