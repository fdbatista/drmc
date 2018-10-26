<?php

use yii\db\Migration;

/**
 * Handles the creation of table `customer`.
 */
class m181022_171556_create_customer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('customer', [
            'id' => $this->primaryKey(),
            'code' => $this->string(15)->unique(),
            'name' => $this->string(150),
            'telephone' => $this->string(25),
        ], ($this->db->driverName === 'mysql') ? 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB' : null);
        $this->addForeignKey('fk_sale_customer', 'sale', 'customer_id', 'customer', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('customer');
    }
}
