<?php

use yii\db\Migration;

/**
 * Class m200103_065253_create_sold_products_current_info_view
 */
class m200103_065253_create_sold_products_current_info_view extends Migration {

    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $this->execute("CREATE OR REPLACE VIEW `v_sold_products_current_info`
        AS
            SELECT 'day' AS `type`, `product`, `sold_items` from v_sold_products_amounts sa inner join v_current_date cd on (sa.type = 'day' and sa.value = cd.day)
            UNION ALL
            SELECT 'week' AS `type`, `product`, `sold_items` from v_sold_products_amounts sa inner join v_current_date cd on (sa.type = 'week' and sa.value = cd.week)
            UNION ALL
            SELECT 'month' AS `type`, `product`, `sold_items` from v_sold_products_amounts sa inner join v_current_date cd on (sa.type = 'month' and sa.value = cd.month)
            UNION ALL
            SELECT 'year' AS `type`, `product`, `sold_items` from v_sold_products_amounts sa inner join v_current_date cd on (sa.type = 'year' and sa.value = cd.year)
            ORDER BY `sold_items` DESC
            "
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        echo "m200103_065253_create_sold_products_current_info_view cannot be reverted.\n";

        return false;
    }

    /*
      // Use up()/down() to run migration code without a transaction.
      public function up()
      {

      }

      public function down()
      {
      echo "m200103_065253_create_sold_products_current_info_view cannot be reverted.\n";

      return false;
      }
     */
}
