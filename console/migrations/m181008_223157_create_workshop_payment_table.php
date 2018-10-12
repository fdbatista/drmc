<?php

use yii\db\Migration;

/**
 * Handles the creation of table `workshop_payment`.
 */
class m181008_223157_create_workshop_payment_table extends Migration {

    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $this->createTable('workshop_payment', [
            'id' => $this->primaryKey(),
            'device_id' => $this->integer()->notNull(),
            'amount' => $this->float()->notNull(),
            'date' => $this->timestamp()->notNull(),
        ], ($this->db->driverName === 'mysql') ? 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB' : null);
        $this->addForeignKey('fk_wspayment_device', 'workshop_payment', 'device_id', 'device', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->dropTable('workshop_payment');
    }

}
