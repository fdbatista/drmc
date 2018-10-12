<?php

use yii\db\Migration;

/**
 * Handles the creation of table `warehouse`.
 */
class m181008_221805_create_warehouse_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('warehouse', [
            'device_id' => $this->integer()->notNull(),
            'code' => $this->string(50)->notNull(),
            'name' => $this->string(50)->notNull(),
            'price_in' => $this->integer()->notNull(),
            'price_public' => $this->integer()->notNull(),
        ], ($this->db->driverName === 'mysql') ? 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB' : null);
        $this->addForeignKey('fk_warehouse_device', 'warehouse', 'device_id', 'device', 'id', 'CASCADE', 'CASCADE');
        $this->createIndex('idx_warehouse_device', 'warehouse', 'device_id', true);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('warehouse');
    }
}
