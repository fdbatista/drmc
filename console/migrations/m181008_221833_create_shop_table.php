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
            'id' => $this->primaryKey(),
            'inventory' => $this->string(50)->notNull(),
            'code' => $this->string(50)->notNull(),
            'items' => $this->integer()->notNull(),
            'price_in' => $this->integer()->notNull(),
            'price_out' => $this->integer()->notNull(),
            'first_discount' => $this->integer()->notNull(),
            'major_discount' => $this->integer()->notNull(),
            'type_id' => $this->integer()->notNull(),
            'model_id' => $this->integer()->notNull()
        ], ($this->db->driverName === 'mysql') ? 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB' : null);
        $this->addForeignKey('fk_shop_type', 'shop', 'type_id', 'device_type', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_shop_model', 'shop', 'model_id', 'brand_model', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('shop');
    }
}
