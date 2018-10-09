<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "warehouse".
 *
 * @property int $device_id
 * @property string $code
 * @property string $name
 * @property int $price_in
 * @property int $price_public
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
            [['device_id', 'code', 'name', 'price_in', 'price_public'], 'required'],
            [['device_id', 'price_in', 'price_public'], 'integer'],
            [['code', 'name'], 'string', 'max' => 50],
            [['device_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'device_id' => Yii::t('app', 'Device ID'),
            'code' => Yii::t('app', 'Code'),
            'name' => Yii::t('app', 'Name'),
            'price_in' => Yii::t('app', 'Price In'),
            'price_public' => Yii::t('app', 'Price Public'),
        ];
    }
}
