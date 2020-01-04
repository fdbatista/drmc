<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "branch".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $address
 * @property string $phone_number
 *
 * @property Sale[] $sales
 * @property Stock[] $stocks
 * @property User[] $users
 * @property Workshop[] $workshops
 */
class Branch extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'branch';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'address', 'phone_number'], 'required'],
            [['name'], 'string', 'max' => 75],
            [['description'], 'string', 'max' => 250],
            [['address', 'phone_number'], 'string', 'max' => 255],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'address' => Yii::t('app', 'Address'),
            'phone_number' => Yii::t('app', 'Phone Number'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSales()
    {
        return $this->hasMany(Sale::className(), ['branch_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStocks()
    {
        return $this->hasMany(Stock::className(), ['branch_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['branch_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorkshops()
    {
        return $this->hasMany(Workshop::className(), ['branch_id' => 'id']);
    }
}
