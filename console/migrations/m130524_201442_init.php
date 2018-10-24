<?php

use yii\db\Migration;

class m130524_201442_init extends Migration {

    public function up() {
        $tableOptions = ($this->db->driverName === 'mysql') ? 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB' : null;
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string(50)->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'first_name' => $this->string(50)->notNull(),
            'last_name' => $this->string(50),
            'telephone' => $this->string(),
            'address' => $this->string(250)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string(50)->notNull()->unique(),
            'sex' => $this->string(1)->notNull()->defaultValue('M'),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);
    }

    public function down() {
        $this->dropTable('{{%user}}');
    }

}
