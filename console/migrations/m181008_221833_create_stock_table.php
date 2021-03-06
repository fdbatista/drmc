<?php

use yii\db\Migration;

/**
 * Handles the creation of table `stock`.
 */
class m181008_221833_create_stock_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('stock', [
            'id' => $this->primaryKey(),
            'code' => $this->string(50)->notNull(),
            'items' => $this->integer()->notNull(),
            'price_in' => $this->double()->notNull(),
            'price_out' => $this->double()->notNull(),
            'first_discount' => $this->double()->notNull(),
            'major_discount' => $this->double()->notNull(),
            'stock_type_id' => $this->integer()->notNull(),
            'device_type_id' => $this->integer()->notNull(),
            'brand_model_id' => $this->integer()->notNull(),
            'branch_id' => $this->integer()->notNull(),
            'updated_at' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ], ($this->db->driverName === 'mysql') ? 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB' : null);
        
        $this->addForeignKey('fk_stock_type', 'stock', 'stock_type_id', 'stock_type', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_stock_devicetype', 'stock', 'device_type_id', 'device_type', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_stock_brandmodel', 'stock', 'brand_model_id', 'brand_model', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_stock_branch', 'stock', 'branch_id', 'branch', 'id', 'CASCADE', 'CASCADE');
        
        $this->createIndex('idx_stock_codestocktype', 'stock', 'code, stock_type_id, branch_id', true);
        $this->createIndex('idx_stock_devicemodel', 'stock', 'device_type_id, brand_model_id, branch_id', true);

        $this->insert('stock', [
            'code' => 'C001',
            'items' => 20,
            'price_in' => 100,
            'price_out' => 150,
            'first_discount' => 10,
            'major_discount' => 30,
            'stock_type_id' => 1,
            'device_type_id' => 1,
            'brand_model_id' => 1,
            'branch_id' => 1,
        ]);

        $this->insert('stock', [
            'code' => 'C002',
            'items' => 20,
            'price_in' => 200,
            'price_out' => 300,
            'first_discount' => 20,
            'major_discount' => 60,
            'stock_type_id' => 1,
            'device_type_id' => 2,
            'brand_model_id' => 10,
            'branch_id' => 1,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('stock');
    }
}
