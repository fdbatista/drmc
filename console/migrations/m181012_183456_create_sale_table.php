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
            'date' => $this->dateTime()->notNull(),
            //'seller_id' => $this->integer()->notNull(),
            'customer_id' => $this->integer()->notNull(),
            'updated_at' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ], ($this->db->driverName === 'mysql') ? 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB' : null);
        $this->addForeignKey('fk_sale_customer', 'sale', 'customer_id', 'user', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('sale');
    }
}
