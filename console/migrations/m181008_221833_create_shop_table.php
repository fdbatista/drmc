<?php

use yii\db\Migration;

/**
 * Handles the creation of table `shop`.
 */
class m181008_221833_create_shop_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('shop', [
            'device_id' => $this->integer()->notNull(),
            'inventory' => $this->string(50)->notNull(),
            'code' => $this->string(50)->notNull(),
            'price_in' => $this->integer()->notNull(),
            'price_out' => $this->integer()->notNull(),
            'first_discount' => $this->integer()->notNull(),
            'major_discount' => $this->integer()->notNull(),
        ], ($this->db->driverName === 'mysql') ? 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB' : null);
        $this->addForeignKey('fk_shop_device', 'shop', 'device_id', 'device', 'id', 'CASCADE', 'CASCADE');
        $this->createIndex('idx_shop_device', 'shop', 'device_id', true);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('shop');
    }
}
