<?php

use yii\db\Migration;

/**
 * Handles the creation of table `sale`.
 */
class m181012_185456_create_sale_item_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('sale_item', [
            'id' => $this->primaryKey(),
            'price_in' => $this->double()->notNull(),
            'price_out' => $this->double()->notNull(),
            'items' => $this->integer()->notNull(),
            'discount_applied' => $this->double(),
            'final_price' => $this->double(),
            'device_type_id' => $this->integer()->notNull(),
            'brand_model_id' => $this->integer()->notNull(),
            'sale_id' => $this->integer()->notNull(),
            'updated_at' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ], ($this->db->driverName === 'mysql') ? 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB' : null);
        $this->addForeignKey('fk_saleitem_devicetype', 'sale_item', 'device_type_id', 'device_type', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_saleitem_brandmodel', 'sale_item', 'brand_model_id', 'brand_model', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_saleitem_sale', 'sale_item', 'sale_id', 'sale', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('sale');
    }
}
