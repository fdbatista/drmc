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
            [['device_id', 'inventory', 'code', 'price_in', 'price_out', 'first_discount', 'major_discount'], 'required'],
            [['device_id', 'price_in', 'price_out', 'first_discount', 'major_discount'], 'integer'],
            [['inventory', 'code'], 'string', 'max' => 50],
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
            'inventory' => Yii::t('app', 'Inventory'),
            'code' => Yii::t('app', 'Code'),
            'price_in' => Yii::t('app', 'Price In'),
            'price_out' => Yii::t('app', 'Price Out'),
            'first_discount' => Yii::t('app', 'First Discount'),
            'major_discount' => Yii::t('app', 'Major Discount'),
        ];
    }
}
