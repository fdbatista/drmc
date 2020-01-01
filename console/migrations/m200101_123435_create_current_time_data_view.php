<?php

use yii\db\Migration;

/**
 * Class m200101_123435_add_current_time_data_view
 */
class m200101_123435_create_current_time_data_view extends Migration {

    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $this->execute("
        CREATE OR REPLACE VIEW `v_current_date`
        AS
        SELECT
            DATE(CURRENT_DATE()) AS `day`,
            DATE_FORMAT(CURRENT_DATE(), '%Y-%u') AS `week`,
            DATE_FORMAT(CURRENT_DATE(), '%M %Y') AS `month`,
            YEAR(CURRENT_DATE()) AS `year`
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        echo "m200101_123435_add_current_time_data_view cannot be reverted.\n";

        return false;
    }

    /*
      // Use up()/down() to run migration code without a transaction.
      public function up()
      {

      }

      public function down()
      {
      echo "m200101_123435_add_current_time_data_view cannot be reverted.\n";

      return false;
      }
     */
}
