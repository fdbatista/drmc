<?php

use common\models\User;
use yii\db\Migration;

/**
 * Class m181015_131651_init_rbac
 */
class m181015_131651_init_rbac extends Migration {

    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $auth = Yii::$app->authManager;
        $adminRole = $auth->createRole('admin');
        $adminRole->description = 'Administrador general de la aplicación';
        $customerRole = $auth->createRole('customer');
        $customerRole->description = 'Cliente de la entidad';
        
        $auth->add($adminRole);
        $auth->add($customerRole);
        $auth->assign($adminRole, 1);
        
        $customer = new User();
        $customer->username = 'customer';
        $customer->first_name = 'Cust';
        $customer->last_name = 'Omer';
        $customer->address = '224 Park Avenue';
        $customer->telephone = '+53 1 234 5678';
        $customer->email = 'customer@mailcom';
        $customer->setPassword('a');
        $customer->generateAuthKey();
        $customer->save(false);
        
        $auth->assign($customerRole, $customer->getId());

        $entities = [
            'brands' => 'marcas',
            'models-brands' => 'modelos',
            'countries' => 'países',
            'device-types' => 'tipos de dispositivos',
            'shop' => 'productos de la tienda',
            'warehouse' => 'productos del almacén',
            'workshop' => 'productos del taller',
            'payments-workshop' => 'cotizaciones del taller',
            'sales' => 'ventas',
            'items-sales' => 'productos de las ventas',
            'app-config' => 'configuración general',
            'users' => 'usuarios',
            'roles-users' => 'usuarios',
            'roles' => 'roles',
        ];

        foreach ($entities as $key => $value) {
            $permission = $auth->createPermission("index-$key");
            $permission->description = "Ver lista de $value";
            $auth->add($permission);
            $auth->addChild($adminRole, $permission);

            $permission = $auth->createPermission("view-$key");
            $permission->description = "Ver detalles de $value";
            $auth->add($permission);
            $auth->addChild($adminRole, $permission);

            $permission = $auth->createPermission("create-$key");
            $permission->description = "Adicionar $value";
            $auth->add($permission);
            $auth->addChild($adminRole, $permission);

            $permission = $auth->createPermission("update-$key");
            $permission->description = "Actualizar $value";
            $auth->add($permission);
            $auth->addChild($adminRole, $permission);

            $permission = $auth->createPermission("delete-$key");
            $permission->description = "Eliminar $value";
            $auth->add($permission);
            $auth->addChild($adminRole, $permission);
        }
        $permission = $auth->createPermission("view-dashboard");
        $permission->description = "Ver panel de control";
        $auth->add($permission);
        $auth->addChild($adminRole, $permission);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $auth = Yii::$app->authManager;
        $auth->removeAll();
    }

}
