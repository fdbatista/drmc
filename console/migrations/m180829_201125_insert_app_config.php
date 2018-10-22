<?php

use yii\db\Migration;

class m180829_201125_insert_app_config extends Migration {

    public function safeUp() {
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
