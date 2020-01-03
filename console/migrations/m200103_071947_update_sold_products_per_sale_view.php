<?php

use yii\db\Migration;

/**
 * Class m200103_071947_update_sold_products_per_sale_view
 */
class m200103_071947_update_sold_products_per_sale_view extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("CREATE OR REPLACE VIEW `v_sold_products_per_sale`
        AS
        SELECT
            DATE(`date`) AS `day`,
            DATE_FORMAT(`date`, '%Y-%u') AS `week`,
            DATE_FORMAT(`date`, '%M %Y') AS `month`,
            YEAR(`date`) AS `year`,
            CONCAT(`dt`.`name`, ' ', `b`.`name`, ' ', `bm`.`name`) AS `product`,
            `items` AS `sold_items`
            FROM `sale` `s`
                INNER JOIN `sale_item` `si` ON (`s`.`id` = `si`.`sale_id`)
                INNER JOIN `device_type` `dt` ON (`si`.`device_type_id` = `dt`.`id`)
                INNER JOIN `brand_model` `bm` ON (`si`.`brand_model_id` = `bm`.`id`)
                INNER JOIN `brand` `b` ON (`bm`.`brand_id` = `b`.`id`)
            WHERE `s`.`status` = 1
            ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200103_071947_update_sold_products_per_sale_view cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200103_071947_update_sold_products_per_sale_view cannot be reverted.\n";

        return false;
    }
    */
}
