<?php

use yii\db\Migration;

/**
 * Handles the creation of table `workshop_pre_diagnosis`.
 */
class m181024_210142_create_workshop_pre_diagnosis_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('workshop_pre_diagnosis', [
            'id' => $this->primaryKey(),
            'workshop_id' => $this->integer()->notNull(),
            'device_type_id' => $this->integer()->notNull(),
            'items' => $this->integer()->notNull(),
        ], ($this->db->driverName === 'mysql') ? 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB' : null);
        $this->addForeignKey('fk_workshopprediagnosis_workshop', 'workshop_pre_diagnosis', 'workshop_id', 'workshop', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_workshopprediagnosis_devicetype', 'workshop_pre_diagnosis', 'device_type_id', 'device_type', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('workshop_pre_diagnosis');
    }
}
