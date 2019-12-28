<?php

use yii\db\Migration;
use yii\rbac\ManagerInterface;

/**
 * Class m181015_131651_init_rbac
 */
class m181015_131651_init_rbac extends Migration {

    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $authManager = Yii::$app->authManager;

        $this->addRole($authManager, 'admin', 'Administrador general de la aplicación', 1);
        $this->addRole($authManager, 'tecnico', 'Técnico de reparaciones', 2);
        $this->addRole($authManager, 'vendedor', 'Vendedor', 2);

        $now = time();
        $this->insert('user', ['username' => 'admin', 'auth_key' => Yii::$app->security->generateRandomString(), 'password_hash' => Yii::$app->security->generatePasswordHash('a'), 'email' => 'admin@server.com', 'created_at' => $now, 'updated_at' => $now, 'first_name' => 'Dannier Rafael', 'last_name' => 'Milanés', 'address' => 'Vivienda, Majibacoa', 'sex' => 'F']);
        $this->insert('user', ['username' => 'tecnico', 'auth_key' => Yii::$app->security->generateRandomString(), 'password_hash' => Yii::$app->security->generatePasswordHash('a'), 'email' => 'tech@server.com', 'created_at' => $now, 'updated_at' => $now, 'first_name' => 'Juan Gabriel', 'last_name' => 'Gabriel', 'address' => 'Michoacán', 'branch_id' => 1]);
        $this->insert('user', ['username' => 'vendedor', 'auth_key' => Yii::$app->security->generateRandomString(), 'password_hash' => Yii::$app->security->generatePasswordHash('a'), 'email' => 'sales@server.com', 'created_at' => $now, 'updated_at' => $now, 'first_name' => 'Jorge', 'last_name' => 'Rosales', 'address' => 'Pendejolandia', 'branch_id' => 1]);

        $authManager->assign($authManager->getRole('admin'), 1);
        $authManager->assign($authManager->getRole('tecnico'), 2);
        $authManager->assign($authManager->getRole('vendedor'), 3);

        $entities = [
            'brands' => 'marcas',
            'models-brands' => 'modelos',
            'countries' => 'países',
            'device-types' => 'tipos de dispositivos',
            'shop' => 'productos de la tienda',
            'warehouse' => 'productos del almacén',
            'workshop' => 'productos del taller',
            'payments-workshop' => 'anticipos del taller',
            'sales' => 'ventas',
            'items-sales' => 'productos de las ventas',
            'users' => 'usuarios',
            'roles-users' => 'roles de los usuarios',
            'roles' => 'roles',
            'branches' => 'sucursales',
        ];

        foreach ($entities as $key => $value) {
            $this->addPermission($authManager, "index-$key", "Ver lista de $value", 'admin');
            $this->addPermission($authManager, "view-$key", "Ver detalles de $value", 'admin');
            $this->addPermission($authManager, "create-$key", "Agregar $value", 'admin');
            $this->addPermission($authManager, "update-$key", "Actualizar $value", 'admin');
            $this->addPermission($authManager, "delete-$key", "Eliminar $value", 'admin');

            if (in_array($key, ['workshop', 'payments-workshop'])) {
                $this->addPermission($authManager, "index-$key", "Ver lista de $value", 'tecnico');
                $this->addPermission($authManager, "view-$key", "Ver detalles de $value", 'tecnico');
                $this->addPermission($authManager, "create-$key", "Agregar $value", 'tecnico');
                $this->addPermission($authManager, "update-$key", "Actualizar $value", 'tecnico');
                $this->addPermission($authManager, "delete-$key", "Eliminar $value", 'tecnico');
            }
            if (in_array($key, ['sales', 'items-sales'])) {
                $this->addPermission($authManager, "index-$key", "Ver lista de $value", 'vendedor');
                $this->addPermission($authManager, "view-$key", "Ver detalles de $value", 'vendedor');
                $this->addPermission($authManager, "create-$key", "Agregar $value", 'vendedor');
                $this->addPermission($authManager, "update-$key", "Actualizar $value", 'vendedor');
                $this->addPermission($authManager, "delete-$key", "Eliminar $value", 'vendedor');
            }
        }
        
        $this->addPermission($authManager, "view-dashboard", "Ver panel de control", 'admin');
        $this->addPermission($authManager, "finish-repair-workshop", "Cerrar reparación", 'admin');
        $this->addPermission($authManager, "print-workshop", "Imprimir reparación", 'admin');
        $this->addPermission($authManager, "print-sales", "Imprimir venta", 'admin');
        $this->addPermission($authManager, "index-app-config", "Ver configuración general", 'admin');
        $this->addPermission($authManager, "update-app-config", "Actualizar configuración general", 'admin');

        $this->addPermission($authManager, "finish-repair-workshop", "Cerrar reparación", 'tecnico');
        $this->addPermission($authManager, "print-workshop", "Imprimir reparación", 'tecnico');

        $this->addPermission($authManager, "print-sales", "Imprimir venta", 'vendedor');
    }

    private function addRole(ManagerInterface $authManager, $name, $description) {
        $role = $authManager->createRole($name);
        $role->description = $description;
        $authManager->add($role);
    }

    private function addPermission(ManagerInterface $authManager, $name, $description, $roleName) {
        $permission = $authManager->getPermission($name);
        if (!$permission) {
            $permission = $authManager->createPermission($name);
            $permission->description = $description;
            $authManager->add($permission);
        }
        $authManager->addChild($authManager->getRole($roleName), $permission);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $auth = Yii::$app->authManager;
        $auth->removeAll();
    }

}
