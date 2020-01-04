<?php

use yii\db\Migration;

/**
 * Class m200104_055938_add_branch_address_and_phone
 */
class m200104_055938_add_branch_address_and_phone extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('branch', 'address', 'string not null');
        $this->addColumn('branch', 'phone_number', 'string not null');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200104_055938_add_branch_address_and_phone cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200104_055938_add_branch_address_and_phone cannot be reverted.\n";

        return false;
    }
    */
}
