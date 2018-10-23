<?php

namespace common\utils;

use common\models\BrandModel;
use common\models\Customer;
use common\models\Device;
use common\models\Shop;
use common\models\User;
use common\models\Warehouse;
use Yii;
use yii\helpers\ArrayHelper;


class StaticMembers {
    
    public static function getModelsAndBrand() {
        return ArrayHelper::map(BrandModel::find()->joinWith('brand')->select(["brand_model.id", "concat(brand.name, ' ', brand_model.name) as name"])->orderBy(['brand.name' => SORT_ASC, 'brand_model.name' => SORT_ASC])->all(), 'id', 'name');
    }
    
    public static function getUsersByRole($role) {
        $customers = Yii::$app->authManager->getUserIdsByRole($role);
        $res = [];
        foreach ($customers as $value) {
            $user = User::findOne($value);
            $res[$value] = $user->getFullName();
        }
        return $res;
    }
    
    public static function getCustomers() {
        return ArrayHelper::map(Customer::find()->all(), 'id', 'code');
    }
    
    public static function getDevicesForSale() {
        $deviceTypes = [];
        $deviceTypes = [];
        $items = Warehouse::find()->all();
        foreach ($items as $item) {
            $deviceType = $item->getType()->one();
            if (!isset($deviceTypes[$deviceType->id])) {
                $deviceTypes[$deviceType->id] = $deviceType->name;
            }
        }
        $items = Shop::find()->all();
        foreach ($items as $item) {
            $deviceType = $item->getType()->one();
            if (!isset($deviceTypes[$deviceType->id])) {
                $deviceTypes[$deviceType->id] = $deviceType->name;
            }
        }
        return $deviceTypes;
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
