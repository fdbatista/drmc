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
            'id' => $this->primaryKey(),
            'pre_diagnosis' => $this->string(250)->notNull(),
            'password' => $this->string(50),
            'pattern' => $this->getDb()->getSchema()->createColumnSchemaBuilder('longtext'),
            'observations' => $this->string(500),
            'signature_in' => $this->string(50),
            'signature_out' => $this->string(50),
            'serial_number' => $this->string()->notNull(),
            'effort' => $this->integer(),
            'receiver_id' => $this->integer(),
            'type_id' => $this->integer()->notNull(),
            'model_id' => $this->integer()->notNull(),
            'updated_at' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ], ($this->db->driverName === 'mysql') ? 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB' : null);
        $this->addForeignKey('fk_workshop_type', 'workshop', 'type_id', 'device_type', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_workshop_model', 'workshop', 'model_id', 'brand_model', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_workshop_receiver', 'workshop', 'receiver_id', 'user', 'id', 'SET NULL', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('workshop');
    }
}
