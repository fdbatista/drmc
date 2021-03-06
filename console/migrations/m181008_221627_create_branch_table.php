<?php

use yii\db\Migration;

/**
 * Handles the creation of table `branch`.
 */
class m181008_221627_create_branch_table extends Migration {

    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $this->createTable('branch', [
            'id' => $this->primaryKey(),
            'name' => $this->string(75)->notNull()->unique(),
            'description' => $this->string(250),
                ], ($this->db->driverName === 'mysql') ? 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB' : null);
        
        $this->addForeignKey('fk_user_branch', 'user', 'branch_id', 'branch', 'id', 'SET NULL', 'CASCADE');

        $this->insert('branch', ['name' => 'Sucursal 1']);
        $this->insert('branch', ['name' => 'Sucursal 2']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->dropTable('branch');
    }

}
