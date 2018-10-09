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
        ]);
        $this->addForeignKey('fk_model_brand', 'brand_model', 'brand_id', 'brand', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->dropTable('brand_model');
    }

}
