<?php

use yii\db\Migration;

/**
 * Class m191231_103123_create_sales_grouped_amounts
 */
class m191231_103123_create_sales_grouped_amounts extends Migration {

    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $this->execute("
        CREATE OR REPLACE VIEW `v_sales_grouped_amounts`
        AS
            SELECT 'day' AS `type`, `day` AS `value`, SUM(`amount`) AS `amount`, SUM(`profit`) AS `profit` FROM `v_sales_daily_amounts` GROUP BY (`day`)
            UNION ALL
            SELECT 'week' AS `type`, `week` AS `value`, SUM(`amount`) AS `amount`, SUM(`profit`) AS `profit` FROM `v_sales_daily_amounts` GROUP BY (`week`)
            UNION ALL
            SELECT 'month' AS `type`, `month` AS `value`, SUM(`amount`) AS `amount`, SUM(`profit`) AS `profit` FROM `v_sales_daily_amounts` GROUP BY (`month`)
            UNION ALL
            SELECT 'year' AS `type`, `year` AS `value`, SUM(`amount`) AS `amount`, SUM(`profit`) AS `profit` FROM `v_sales_daily_amounts` GROUP BY (`year`)
        "
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        echo "m191231_103123_create_sales_grouped_amounts cannot be reverted.\n";

        return false;
    }

    /*
      // Use up()/down() to run migration code without a transaction.
      public function up()
      {

      }

      public function down()
      {
      echo "m191231_103123_create_sales_grouped_amounts cannot be reverted.\n";

      return false;
      }
     */
}
