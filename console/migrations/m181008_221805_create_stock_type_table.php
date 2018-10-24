<?php

use yii\db\Migration;

/**
 * Handles the creation of table `warehouse`.
 */
class m181008_221805_create_stock_type_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('stock_type', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull()->unique(),
        ], ($this->db->driverName === 'mysql') ? 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB' : null);
    
        $this->insert('stock_type', ['name' => 'Tienda']);
        $this->insert('stock_type', ['name' => 'Almacén']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('warehouse');
    }
}
