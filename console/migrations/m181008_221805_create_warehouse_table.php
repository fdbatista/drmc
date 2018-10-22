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
            'id' => $this->primaryKey(),
            'code' => $this->integer()->notNull(),
            'name' => $this->string(50),
            'price_in' => $this->double()->notNull(),
            'price_out' => $this->double()->notNull(),
            'items' => $this->integer()->notNull(),
            'type_id' => $this->integer()->notNull(),
            'model_id' => $this->integer()->notNull(),
            'updated_at' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ], ($this->db->driverName === 'mysql') ? 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB' : null);
        $this->addForeignKey('fk_warehouse_type', 'warehouse', 'type_id', 'device_type', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_warehouse_model', 'warehouse', 'model_id', 'brand_model', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('warehouse');
    }
}
