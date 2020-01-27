<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "v_sold_products_current_info".
 *
 * @property int $branch_id
 * @property string $type
 * @property string $product
 * @property string $sold_items
 */
class VSoldProductsCurrentInfo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'v_sold_products_current_info';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['branch_id'], 'integer'],
            [['sold_items'], 'number'],
            [['type'], 'string', 'max' => 5],
            [['product'], 'string', 'max' => 202],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'branch_id' => Yii::t('app', 'Branch ID'),
            'type' => Yii::t('app', 'Type'),
            'product' => Yii::t('app', 'Product'),
            'sold_items' => Yii::t('app', 'Sold Items'),
        ];
    }
}
