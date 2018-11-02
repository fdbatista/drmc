<?php

use yii\db\Migration;

/**
 * Handles the creation of table `device_type`.
 */
class m181008_221626_create_device_type_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('device_type', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull()->unique(),
            'stock_type_id' => $this->integer()->notNull(),
        ], ($this->db->driverName === 'mysql') ? 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB' : null);
        
        $this->insert('device_type', ['name' => 'Celular', 'stock_type_id' => 1]);
        $this->insert('device_type', ['name' => 'Laptop', 'stock_type_id' => 1]);
        $this->insert('device_type', ['name' => 'Cámara digital', 'stock_type_id' => 1]);
        $this->insert('device_type', ['name' => 'PC de escritorio', 'stock_type_id' => 1]);
        $this->insert('device_type', ['name' => 'Tablet', 'stock_type_id' => 1]);
        $this->insert('device_type', ['name' => 'Cámara frontal', 'stock_type_id' => 2]);
        $this->insert('device_type', ['name' => 'Cámara trasera', 'stock_type_id' => 2]);
        $this->insert('device_type', ['name' => 'Pantalla', 'stock_type_id' => 2]);
        $this->insert('device_type', ['name' => 'Táctil', 'stock_type_id' => 2]);
        $this->insert('device_type', ['name' => 'Cargador', 'stock_type_id' => 2]);
        $this->insert('device_type', ['name' => 'Cable de alimentación', 'stock_type_id' => 2]);
        $this->insert('device_type', ['name' => 'Mica', 'stock_type_id' => 2]);
        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('device_type');
    }
}
