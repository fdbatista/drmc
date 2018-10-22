<?php

use yii\db\Migration;

/**
 * Handles the creation of table `shop`.
 */
class m181008_221833_create_shop_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('shop', [
            'id' => $this->primaryKey(),
            'inventory' => $this->string(50),
            'code' => $this->string(50)->notNull(),
            'items' => $this->integer()->notNull(),
            'price_in' => $this->double()->notNull(),
            'price_out' => $this->double()->notNull(),
            'first_discount' => $this->double()->notNull(),
            'major_discount' => $this->double()->notNull(),
            'type_id' => $this->integer()->notNull(),
            'model_id' => $this->integer()->notNull(),
            'updated_at' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ], ($this->db->driverName === 'mysql') ? 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB' : null);
        $this->addForeignKey('fk_shop_type', 'shop', 'type_id', 'device_type', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_shop_model', 'shop', 'model_id', 'brand_model', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('shop');
    }
}
