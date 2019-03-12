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
            'customer_id' => $this->integer(),
            'status' => $this->integer(2)->notNull()->defaultValue(0),
            'branch_id' => $this->integer()->notNull(),
            'updated_at' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ], ($this->db->driverName === 'mysql') ? 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB' : null);
        
        $this->addForeignKey('fk_sale_branch', 'sale', 'branch_id', 'branch', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('sale');
    }
}
