<?php

use yii\db\Migration;

/**
 * Class m200101_121519_add_workshop_pre_diagnosis_price_in
 */
class m200101_121519_add_workshop_pre_diagnosis_price_in extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameColumn('workshop_pre_diagnosis', 'price_per_unit', 'price_out');
        $this->addColumn('workshop_pre_diagnosis', 'price_in', 'integer not null');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200101_121519_add_workshop_pre_diagnosis_price_in cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200101_121519_add_workshop_pre_diagnosis_price_in cannot be reverted.\n";

        return false;
    }
    */
}
