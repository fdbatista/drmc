<?php

use yii\db\Migration;

/**
 * Handles the creation of table `workshop`.
 */
class m181008_221747_create_workshop_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('workshop', [
            'device_id' => $this->integer()->notNull(),
            'pre_diagnosis' => $this->string(250)->notNull(),
            'password_pattern' => $this->string(250),
            'observations' => $this->string(500),
            'signature_in' => $this->string(50),
            'signature_out' => $this->string(50),
            'effort' => $this->integer(),
            'receiver_id' => $this->integer(),
        ]);
        $this->addForeignKey('fk_workshop_device', 'workshop', 'device_id', 'device', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_workshop_receiver', 'workshop', 'receiver_id', 'user', 'id', 'SET NULL', 'CASCADE');
        $this->createIndex('idx_workshop_device', 'workshop', 'device_id', true);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('workshop');
    }
}
