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
        ], ($this->db->driverName === 'mysql') ? 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB' : null);
        
        $this->insert('device_type', ['name' => 'Celular']);
        $this->insert('device_type', ['name' => 'Laptop']);
        $this->insert('device_type', ['name' => 'Cámara digital']);
        $this->insert('device_type', ['name' => 'PC de escritorio']);
        $this->insert('device_type', ['name' => 'Tablet']);
        $this->insert('device_type', ['name' => 'Cámara frontal']);
        $this->insert('device_type', ['name' => 'Cámara trasera']);
        $this->insert('device_type', ['name' => 'Pantalla']);
        $this->insert('device_type', ['name' => 'Táctil']);
        $this->insert('device_type', ['name' => 'Cargador']);
        $this->insert('device_type', ['name' => 'Cable de alimentación']);
        $this->insert('device_type', ['name' => 'Mica']);
        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('device_type');
    }
}
