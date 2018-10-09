<?php

use yii\db\Migration;

class m180829_165801_create_role_table extends Migration {

    public function safeUp() {
        $tableOptions = ($this->db->driverName === 'mysql') ? 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB' : null;
        $this->createTable('role', [
            'id' => $this->primaryKey(),
            'name' => $this->string(35)->notNull()->unique(),
        ], $tableOptions);
    }

    public function safeDown() {
        $this->dropTable('role');
    }
}
