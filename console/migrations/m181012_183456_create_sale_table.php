<?php

use yii\db\Migration;

/**
 * Handles the creation of table `sale`.
 */
class m181012_183456_create_sale_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('sale', [
            'id' => $this->primaryKey(),
            'price_in' => $this->integer()->notNull(),
            'price_out' => $this->integer()->notNull(),
            'items' => $this->integer()->notNull(),
            'type_id' => $this->integer()->notNull(),
            'model_id' => $this->integer()->notNull(),
            'updated_at' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ], ($this->db->driverName === 'mysql') ? 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB' : null);
        $this->addForeignKey('fk_sale_type', 'sale', 'type_id', 'device_type', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_sale_model', 'sale', 'model_id', 'brand_model', 'id', 'CASCADE', 'CASCADE');
        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('sale');
    }
}
