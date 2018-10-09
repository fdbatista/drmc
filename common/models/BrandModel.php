<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "brand_model".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $brand_id
 */
class BrandModel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'brand_model';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'brand_id'], 'required'],
            [['brand_id'], 'integer'],
            [['name'], 'string', 'max' => 75],
            [['description'], 'string', 'max' => 250],
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
            'brand_id' => Yii::t('app', 'Brand ID'),
        ];
    }
}
