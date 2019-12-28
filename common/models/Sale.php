<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sale".
 *
 * @property int $id
 * @property string $date
 * @property int $customer_id
 * @property int $status
 * @property int $branch_id
 * @property string $updated_at
 * @property int $total_price
 * @property int $discount_applied
 * @property string $serial_number
 *
 * @property Branch $branch
 * @property Customer $customer
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
            [['date', 'branch_id'], 'required'],
            [['date', 'updated_at'], 'safe'],
            [['customer_id', 'status', 'branch_id', 'total_price', 'discount_applied'], 'integer'],
            [['serial_number'], 'string', 'max' => 255],
            [['branch_id'], 'exist', 'skipOnError' => true, 'targetClass' => Branch::className(), 'targetAttribute' => ['branch_id' => 'id']],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'id']],
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
            'status' => Yii::t('app', 'Status'),
            'branch_id' => Yii::t('app', 'Branch ID'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'total_price' => Yii::t('app', 'Total Price'),
            'discount_applied' => Yii::t('app', 'Discount Applied'),
            'serial_number' => Yii::t('app', 'Serial Number'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBranch()
    {
        return $this->hasOne(Branch::className(), ['id' => 'branch_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaleItems()
    {
        return $this->hasMany(SaleItem::className(), ['sale_id' => 'id']);
    }
}
