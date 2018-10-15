<?php

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
        $admin = $auth->createRole('admin');
        $admin->description = 'Administrador general de la aplicación';
        $auth->add($admin);
        $auth->assign($admin, 1);

        $entities = [
            'brands' => 'marcas',
            'models-brands' => 'modelos',
            'countries' => 'países',
            'device-types' => 'tipos de dispositivos',
            'shop-items' => 'productos de la tienda',
            'warehouse-items' => 'productos del almacén',
            'workshop-items' => 'productos del taller',
            'sales' => 'ventas',
            'app-config' => 'configuración general',
            'users' => 'usuarios',
            'roles' => 'roles',
        ];

        foreach ($entities as $key => $value) {
            $perm = $auth->createPermission("index-$key");
            $perm->description = "Ver lista de $value";
            $auth->add($perm);
            $auth->addChild($admin, $perm);

            $perm = $auth->createPermission("view-$key");
            $perm->description = "Ver detalles de $value";
            $auth->add($perm);
            $auth->addChild($admin, $perm);

            $perm = $auth->createPermission("create-$key");
            $perm->description = "Adicionar $value";
            $auth->add($perm);
            $auth->addChild($admin, $perm);

            $perm = $auth->createPermission("update-$key");
            $perm->description = "Actualizar $value";
            $auth->add($perm);
            $auth->addChild($admin, $perm);

            $perm = $auth->createPermission("delete-$key");
            $perm->description = "Eliminar $value";
            $auth->add($perm);
            $auth->addChild($admin, $perm);
        }
        $perm = $auth->createPermission("view-dashboard");
        $perm->description = "Ver panel de control";
        $auth->add($perm);
        $auth->addChild($admin, $perm);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $auth = Yii::$app->authManager;
        $auth->removeAll();
    }

    /*
      // Use up()/down() to run migration code without a transaction.
      public function up()
      {

      }

      public function down()
      {
      echo "m181015_131651_init_rbac cannot be reverted.\n";

      return false;
      }
     */
}
