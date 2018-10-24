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
        $auth->add($adminRole);
        
        $techRole = $auth->createRole('tech');
        $techRole->description = 'Técnico de reparaciones';
        $auth->add($techRole);
        
        $now = time();
        $this->insert('user', ['username' => 'admin', 'auth_key' => Yii::$app->security->generateRandomString(), 'password_hash' => Yii::$app->security->generatePasswordHash('a'), 'email' => 'admin@server.com', 'created_at' => $now, 'updated_at' => $now, 'first_name' => 'Dannier', 'last_name' => 'Milanés', 'address' => 'Vivienda, Majibacoa']);
        $this->insert('user', ['username' => 'tech', 'auth_key' => Yii::$app->security->generateRandomString(), 'password_hash' => Yii::$app->security->generatePasswordHash('a'), 'email' => 'tech@server.com', 'created_at' => $now, 'updated_at' => $now, 'first_name' => 'Juan', 'last_name' => 'Gabriel', 'address' => 'Michoacán']);
        
        $auth->assign($adminRole, 1);
        $auth->assign($techRole, 2);

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
