<?php

use yii\db\Migration;

/**
 * Class m191231_105701_create_sold_products_amounts_view
 */
class m191231_105701_create_sold_products_amounts_view extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
        CREATE OR REPLACE VIEW `v_sold_products_amounts`
        AS
            SELECT 'day' AS `type`, `day` AS `value`, `product`, SUM(`sold_items`) AS `sold_items` FROM `v_sold_products_per_sale` GROUP BY `day`,`product`
            UNION ALL
            SELECT 'week' AS `type`, `week` AS `value`, `product`, SUM(`sold_items`) AS `sold_items` FROM `v_sold_products_per_sale` GROUP BY `week`,`product`
            UNION ALL
            SELECT 'month' AS `type`, `month` AS `value`, `product`, SUM(`sold_items`) AS `sold_items` FROM `v_sold_products_per_sale` GROUP BY `month`,`product`
            UNION ALL
            SELECT 'year' AS `type`, `year` AS `value`, `product`, SUM(`sold_items`) AS `sold_items` FROM `v_sold_products_per_sale` GROUP BY `year`,`product`
            ORDER BY `type` ASC, `sold_items` DESC
            "
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191231_105701_create_sold_products_amounts_view cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191231_105701_create_sold_products_amounts_view cannot be reverted.\n";

        return false;
    }
    */
}
