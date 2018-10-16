<?php

namespace common\utils;

use common\models\BrandModel;
use common\models\Device;
use common\models\User;
use Yii;
use yii\helpers\ArrayHelper;


class StaticMembers {
    
    public static function getModelsAndBrand() {
        return ArrayHelper::map(BrandModel::find()->joinWith('brand')->select(["brand_model.id", "concat(brand.name, ' ', brand_model.name) as name"])->orderBy(['brand.name' => SORT_ASC, 'brand_model.name' => SORT_ASC])->all(), 'id', 'name');
    }
    
    public static function getCustomers() {
        $customers = Yii::$app->authManager->getUserIdsByRole('customer');
        $res = [];
        foreach ($customers as $value) {
            $user = User::findOne($value);
            $res[$value] = $user->getFullName();
        }
        return $res;
    }
    
    public static function getDevices() {
        $devices = Device::find()->all();
        $res = [];
        
        foreach ($devices as $device) {
            $model = $device->getModel()->one();
            $res[] = [
                'id' => $device->id,
                'name' => $model->getBrand()->one()->name . ' ' . $model->name
            ];
        }
        $res = ArrayHelper::map($res, 'id', 'name');
        return $res;
    }
    
    public static function getModelAndBrandName(BrandModel $model) {
        return $model->getBrand()->one()->name . ' ' . $model->name;
    }
}
