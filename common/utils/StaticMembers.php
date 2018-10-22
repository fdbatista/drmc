<?php

namespace common\utils;

use common\models\BrandModel;
use common\models\Customer;
use common\models\Device;
use common\models\Shop;
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
    
    public static function getDevicesForSale() {
        return ArrayHelper::map(Yii::$app->getDb()->createCommand('select `id`, `name` from (select `d`.`id`, `d`.`name`, (select distinct 1 from `shop` `s` where `s`.`type_id` = `d`.`id`) `shop`, (select distinct 1 from `warehouse` `w` where `w`.`type_id` = `d`.`id`) `warehouse` from `device_type` `d`) `sq` where `sq`.`shop` = 1 or `sq`.`warehouse` = 1')->queryAll(), 'id', 'name');
    }
    
    public static function getBrandModelsForSale() {
        return ArrayHelper::map(Yii::$app->getDb()->createCommand('select `id`, `name` from (select `d`.`id`, `d`.`name`, (select distinct 1 from `shop` `s` where `s`.`model_id` = `d`.`id`) `shop`, (select distinct 1 from `warehouse` `w` where `w`.`model_id` = `d`.`id`) `warehouse` from `brand_model` `d`) `sq` where `sq`.`shop` = 1 or `sq`.`warehouse` = 1')->queryAll(), 'id', 'name');
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
