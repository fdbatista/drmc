<?php

use yii\db\Migration;

/**
 * Class m200101_141920_create_sales_current_info_view
 */
class m200101_141920_create_sales_current_info_view extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
        CREATE OR REPLACE VIEW `v_sales_current_info`
        AS
            SELECT 'day' AS `type`, amount, profit from v_sales_grouped_amounts sa inner join v_current_date cd on (sa.type = 'day' and sa.value = cd.day)
            UNION ALL
            SELECT 'week' AS `type`,  amount, profit from v_sales_grouped_amounts sa inner join v_current_date cd on (sa.type = 'week' and sa.value = cd.week)
            UNION ALL
            SELECT 'month' AS `type`,  amount, profit from v_sales_grouped_amounts sa inner join v_current_date cd on (sa.type = 'month' and sa.value = cd.month)
            UNION ALL
            SELECT 'year' AS `type`,  amount, profit from v_sales_grouped_amounts sa inner join v_current_date cd on (sa.type = 'year' and sa.value = cd.year)
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200101_141920_create_sales_current_info_view cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200101_141920_create_sales_current_info_view cannot be reverted.\n";

        return false;
    }
    */
}
