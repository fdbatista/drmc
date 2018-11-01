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
            'password' => $this->string(50),
            'pattern' => $this->string(),
            'pattern_gif' => $this->getDb()->getSchema()->createColumnSchemaBuilder('longtext'),
            'observations' => $this->string(500),
            'signature_in' => $this->string(50),
            'signature_out' => $this->string(50),
            'date_received' => $this->date()->notNull(),
            'date_closed' => $this->dateTime(),
            'warranty_until' => $this->date(),
            'updated_at' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'serial_number' => $this->string()->notNull(),
            'customer_name' => $this->string()->notNull(),
            'customer_telephone' => $this->string()->notNull(),
            'folio_number' => $this->string()->unique()->notNull(),
            'discount_applied' => $this->double(),
            'final_price' => $this->double(),
            'effort' => $this->double()->notNull(),
            'status' => $this->integer(2)->notNull()->defaultValue(0),
            'receiver_id' => $this->integer(),
            'device_type_id' => $this->integer()->notNull(),
            'brand_model_id' => $this->integer()->notNull(),
            'updated_at' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ], ($this->db->driverName === 'mysql') ? 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB' : null);
        $this->addForeignKey('fk_workshop_devicetype', 'workshop', 'device_type_id', 'device_type', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_workshop_brandmodel', 'workshop', 'brand_model_id', 'brand_model', 'id', 'CASCADE', 'CASCADE');
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
