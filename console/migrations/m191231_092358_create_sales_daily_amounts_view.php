<?php

use yii\db\Migration;

/**
 * Class m191231_092358_create_sale_data_view
 */
class m191231_092358_create_sales_daily_amounts_view extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
            CREATE OR REPLACE VIEW `v_sales_daily_amounts`
            AS
            SELECT
                DATE(`date`) AS `day`,
                DATE_FORMAT(`date`, '%Y-%u') AS `week`,
                DATE_FORMAT(`date`, '%M %Y') AS `month`,
                YEAR(`date`) AS `year`,
                `total_price` AS `amount`,
                (`total_price`- (SELECT SUM(`price_in` * `items`) FROM `sale_item` WHERE `sale_id` = `s`.`id`)) AS `profit`
                FROM `sale` `s`
                WHERE `s`.`status` = 1
                "
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191231_092358_create_sale_data_view cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191231_092358_create_sale_data_view cannot be reverted.\n";

        return false;
    }
    */
}
