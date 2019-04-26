<?php

namespace common\utils;

use common\models\BrandModel;
use common\models\Customer;
use common\models\DeviceType;
use common\models\Stock;
use common\models\User;
use Yii;
use yii\helpers\ArrayHelper;
use yii\rbac\ManagerInterface;
use yii\rbac\Role;

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
            $stockItems = Stock::findAll(['branch_id' => Yii::$app->session->get('branch_id'), 'device_type_id' => $deviceTypeId]);
            foreach ($stockItems as $item) {
                if ($item->items > 0) {
                    $model = $item->brandModel;
                    $res[$deviceType->name][] = ['id' => $model->id, 'name' => $model->brand->name . ' ' . $model->name];
                }
            }
        }
        return $res;
    }

    public static function getWarehouseItemsByBrandModel($brandModelId) {
        $res = [];
        $brandModel = BrandModel::findOne($brandModelId);

        if ($brandModel) {
            $res[$brandModel->name] = [];
            $stockItems = Stock::findAll(['branch_id' => Yii::$app->session->get('branch_id'), 'stock_type_id' => 2, 'brand_model_id' => $brandModelId]);
            foreach ($stockItems as $item) {
                $model = $item->getDeviceType()->one();
                $res[$brandModel->name][] = ['id' => $model->id, 'name' => $model->name . ' (max: ' . $item->items . ')', 'options' => ['data-major-discount' => $item->major_discount, 'data-max-items' => $item->items]];
            }
        }
        return $res;
    }

    public static function getBrandModelsForSale($deviceTypeId) {
        $brandModels = [];
        $items = Stock::findAll(['branch_id' => Yii::$app->session->get('branch_id'), 'device_type_id' => $deviceTypeId]);
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
        $items = Stock::find()->where(['branch_id' => Yii::$app->session->get('branch_id')])->all();
        foreach ($items as $item) {
            $deviceType = $item->getDeviceType()->one();
            if (!isset($deviceTypes[$deviceType->id])) {
                $deviceTypes[$deviceType->id] = $deviceType->name;
            }
        }
        return $deviceTypes;
    }

    public static function getRoles() {
        $res = ArrayHelper::map(Yii::$app->authManager->getRoles(), 'name', 'name');
        return $res;
    }

    public static function getAuthEntitiesAndPerms(ManagerInterface $authManager, Role $role) {
        $entities = [
            'brands' => 'Marcas',
            'models-brands' => 'Modelos',
            'device-types' => 'Tipos de dispositivos',
            'shop' => 'Tienda',
            'warehouse' => 'Almacén',
            'workshop' => 'Taller',
            'payments-workshop' => 'Anticipos del taller',
            'sales' => 'Ventas',
            'items-sales' => 'Dispositivos de las ventas',
            'users' => 'Usuarios',
            'roles' => 'Roles',
                //'app-config' => 'Configuración general',
        ];
        $perms = [
                ['id' => 'index', 'name' => 'Listar contenido'],
                ['id' => 'view', 'name' => 'Ver detalles'],
                ['id' => 'create', 'name' => 'Agregar'],
                ['id' => 'update', 'name' => 'Actualizar'],
                ['id' => 'delete', 'name' => 'Eliminar'],
        ];
        $res = [];

        foreach ($entities as $entityKey => $entityValue) {
            $res[$entityValue] = [
                'perms' => []
            ];
            foreach ($perms as $perm) {
                $permFullKey = $perm['id'] . "-$entityKey";
                $res[$entityValue]['perms'][$permFullKey] = [
                    'name' => $perm['name'],
                    'value' => $authManager->hasChild($role, $authManager->getPermission($permFullKey))
                ];
            }
            if ($entityKey === 'workshop') {
                $res[$entityValue]['perms']['finish-repair-workshop'] = [
                    'name' => 'Cerrar reparación',
                    'value' => $authManager->hasChild($role, $authManager->getPermission('finish-repair-workshop'))
                ];
                $res[$entityValue]['perms']['print-workshop'] = [
                    'name' => 'Imprimir comprobante',
                    'value' => $authManager->hasChild($role, $authManager->getPermission('finish-repair-workshop'))
                ];
            }
        }

        $permFullKey = "index-app-config";
        $res['Configuración general']['perms'][$permFullKey] = [
            'name' => 'Listar contenido',
            'value' => $authManager->hasChild($role, $authManager->getPermission($permFullKey))
        ];
        $permFullKey = "update-app-config";
        $res['Configuración general']['perms'][$permFullKey] = [
            'name' => 'Actualizar',
            'value' => $authManager->hasChild($role, $authManager->getPermission($permFullKey))
        ];
        $permFullKey = "view-dashboard";
        $res['Panel de control']['perms'][$permFullKey] = [
            'name' => 'Listar contenido',
            'value' => $authManager->hasChild($role, $authManager->getPermission($permFullKey))
        ];

        return $res;
    }

    public static function getModelAndBrandName(BrandModel $model) {
        return $model->getBrand()->one()->name . ' ' . $model->name;
    }

}
