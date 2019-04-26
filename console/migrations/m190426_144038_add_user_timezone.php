<?php

use yii\db\Migration;

/**
 * Class m190426_144038_add_user_timezone
 */
class m190426_144038_add_user_timezone extends Migration {

    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $this->addColumn('user', 'user_data', 'json');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        echo "m190426_144038_add_user_timezone cannot be reverted.\n";

        return false;
    }

    /*
      // Use up()/down() to run migration code without a transaction.
      public function up()
      {

      }

      public function down()
      {
      echo "m190426_144038_add_user_timezone cannot be reverted.\n";

      return false;
      }
     */
}
