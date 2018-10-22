<?php

use yii\db\Migration;

/**
 * Handles the creation of table `brand_model`.
 */
class m181008_221438_create_brand_model_table extends Migration {

    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $this->createTable('brand_model', [
            'id' => $this->primaryKey(),
            'name' => $this->string(75)->notNull()->unique(),
            'description' => $this->string(250),
            'brand_id' => $this->integer()->notNull(),
                ], ($this->db->driverName === 'mysql') ? 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB' : null);
        $this->addForeignKey('fk_model_brand', 'brand_model', 'brand_id', 'brand', 'id', 'CASCADE', 'CASCADE');

        //Samsung
        $this->insert('brand_model', ['name' => 'Galaxy A9', 'brand_id' => 1]);
        $this->insert('brand_model', ['name' => 'Galaxy S3', 'brand_id' => 1]);
        $this->insert('brand_model', ['name' => 'Note 1', 'brand_id' => 1]);

        //Apple
        $this->insert('brand_model', ['name' => 'iPad 3', 'brand_id' => 2]);
        $this->insert('brand_model', ['name' => 'iPad 5', 'brand_id' => 2]);
        $this->insert('brand_model', ['name' => 'iPhone 7', 'brand_id' => 2]);

        //Alcatel
        $this->insert('brand_model', ['name' => 'OneTouch 1052G', 'brand_id' => 3]);

        //Huawei
        $this->insert('brand_model', ['name' => 'Ascend', 'brand_id' => 4]);

        //Blu
        $this->insert('brand_model', ['name' => 'Studio X5', 'brand_id' => 5]);

        //Acer
        $this->insert('brand_model', ['name' => 'Aspire', 'brand_id' => 5]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->dropTable('brand_model');
    }

}
