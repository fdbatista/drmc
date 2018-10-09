<?php

use yii\db\Migration;

class m180829_201125_insert_users_roles_config extends Migration {

    public function safeUp() {
        $now = time();
        $this->insert('user', ['username' => 'admin', 'auth_key' => Yii::$app->security->generateRandomString(), 'password_hash' => Yii::$app->security->generatePasswordHash('a'), 'email' => 'admin@server.com', 'created_at' => $now, 'updated_at' => $now]);
        
        $this->insert('role', ['name' => 'Administrador']);
        $this->insert('role', ['name' => 'Usuario']);
        
        $this->insert('user_role', ['user_id' => 1, 'role_id' => 1]);
        $this->insert('user_role', ['user_id' => 1, 'role_id' => 2]);
        
        $this->insert('app_config', [
            'app_title' => 'My App',
            'about' => 'App Description',
            'address' => 'Bla bla',
            'email' => 'app@server.com',
            'phone' => '+53 5 123 4567',
        ]);
    }

    public function safeDown() {
        return false;
    }
}
