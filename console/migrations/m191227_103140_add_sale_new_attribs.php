<?php

use yii\db\Migration;

/**
 * Class m191227_103140_add_sale_total_price
 */
class m191227_103140_add_sale_new_attribs extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('sale', 'total_price', 'integer NOT NULL default 0');
        $this->addColumn('sale', 'discount_applied', 'integer NOT NULL default 0');
        $this->addColumn('sale', 'serial_number', 'string');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191227_103140_add_sale_total_price cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191227_103140_add_sale_total_price cannot be reverted.\n";

        return false;
    }
    */
}
