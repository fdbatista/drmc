<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "v_sold_products_amounts".
 *
 * @property string $type
 * @property string $value
 * @property string $product
 * @property string $sold_items
 */
class VSoldProductsAmounts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'v_sold_products_amounts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sold_items'], 'number'],
            [['type'], 'string', 'max' => 5],
            [['value'], 'string', 'max' => 11],
            [['product'], 'string', 'max' => 202],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'type' => Yii::t('app', 'Type'),
            'value' => Yii::t('app', 'Value'),
            'product' => Yii::t('app', 'Product'),
            'sold_items' => Yii::t('app', 'Sold Items'),
        ];
    }
}
