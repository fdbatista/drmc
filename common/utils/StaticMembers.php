<?php

namespace common\utils;

use common\models\BrandModel;
use common\models\Customer;
use common\models\DeviceType;
use common\models\Stock;
use common\models\User;
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
    
    public static function getBrandModelsByDeviceType($deviceTypeId) {
        $res = [];
        $deviceType = DeviceType::findOne($deviceTypeId);

        if ($deviceType) {
            $res[$deviceType->name] = [];
            $stockItems = Stock::findAll(['device_type_id' => $deviceTypeId]);
            foreach ($stockItems as $item) {
                $model = $item->getBrandModel()->one();
                $res[$deviceType->name][] = ['id' => $model->id, 'name' => $model->name];
            }
        }
        return $res;
    }
    
    public static function getBrandModelsForSale($deviceTypeId) {
        $brandModels = [];
        $items = Stock::findAll(['device_type_id' => $deviceTypeId]);
        foreach ($items as $item) {
            $brandModel = $item->getBrandModel()->one();
            if (!isset($brandModels[$brandModel->id])) {
                $brandModels[$brandModel->id] = $brandModel->name;
            }
        }
        return $brandModels;
    }
    
    public static function getDevicesForSale() {
        $deviceTypes = [];
        $items = Stock::find()->all();
        foreach ($items as $item) {
            $deviceType = $item->getDeviceType()->one();
            if (!isset($deviceTypes[$deviceType->id])) {
                $deviceTypes[$deviceType->id] = $deviceType->name;
            }
        }
        return $deviceTypes;
    }
    
    public static function getModelAndBrandName(BrandModel $model) {
        return $model->getBrand()->one()->name . ' ' . $model->name;
    }
}
