<?php

use yii\db\Migration;

class m180829_165803_create_app_config_table extends Migration {

    public function safeUp() {
        $tableOptions = ($this->db->driverName === 'mysql') ? 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB' : null;
        $this->createTable('app_config', [
            'id' => $this->primaryKey(),
            'app_title' => $this->string(50)->notNull(),
            'about' => $this->string(350)->notNull(),
            'address' => $this->string(250),
            'email' => $this->string(50),
            'phone' => $this->string(50),
        ], $tableOptions);
    }

    public function safeDown() {
        $this->dropTable('app_config');
    }
}
