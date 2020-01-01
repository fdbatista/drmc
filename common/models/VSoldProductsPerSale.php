<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "v_sold_products_per_sale".
 *
 * @property string $day
 * @property string $week
 * @property string $month
 * @property int $year
 * @property string $product
 * @property int $sold_items
 */
class VSoldProductsPerSale extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'v_sold_products_per_sale';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['day'], 'safe'],
            [['year', 'sold_items'], 'integer'],
            [['sold_items'], 'required'],
            [['week', 'month'], 'string', 'max' => 7],
            [['product'], 'string', 'max' => 202],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'day' => Yii::t('app', 'Day'),
            'week' => Yii::t('app', 'Week'),
            'month' => Yii::t('app', 'Month'),
            'year' => Yii::t('app', 'Year'),
            'product' => Yii::t('app', 'Product'),
            'sold_items' => Yii::t('app', 'Sold Items'),
        ];
    }
}
