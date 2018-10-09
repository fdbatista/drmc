<?php

use yii\db\Migration;

class m180829_165802_create_user_role_table extends Migration {

    public function safeUp() {
        $tableOptions = ($this->db->driverName === 'mysql') ? 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB' : null;
        $this->createTable('user_role', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'role_id' => $this->integer()->notNull(),
        ], $tableOptions);
        $this->addForeignKey('fk_userrole_user', 'user_role', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_userrole_role', 'user_role', 'role_id', 'role', 'id', 'CASCADE', 'CASCADE');
        $this->createIndex('idx_userrole_userrole', 'user_role', 'user_id, role_id', true);
    }
    
    public function safeDown() {
        $this->dropTable('user_role');
    }
}
