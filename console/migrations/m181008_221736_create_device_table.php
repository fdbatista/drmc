<?php

use yii\db\Migration;

/**
 * Handles the creation of table `device`.
 */
class m181008_221736_create_device_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('device', [
            'id' => $this->primaryKey(),
            'type_id' => $this->integer()->notNull(),
            'model_id' => $this->integer()->notNull(),
        ], ($this->db->driverName === 'mysql') ? 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB' : null);
        $this->addForeignKey('fk_device_type', 'device', 'type_id', 'device_type', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_device_model', 'device', 'model_id', 'brand_model', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('Dispositivo');
    }
}
