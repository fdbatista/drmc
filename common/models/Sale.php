<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sale".
 *
 * @property int $id
 * @property string $date
 * @property int $customer_id
 * @property string $updated_at
 *
 * @property User $customer
 * @property SaleItem[] $saleItems
 */
class Sale extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sale';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date', 'customer_id'], 'required'],
            [['date', 'updated_at'], 'safe'],
            [['customer_id'], 'integer'],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['customer_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'date' => Yii::t('app', 'Date'),
            'customer_id' => Yii::t('app', 'Customer ID'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(User::className(), ['id' => 'customer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaleItems()
    {
        return $this->hasMany(SaleItem::className(), ['sale_id' => 'id']);
    }
}
