<?php

use yii\db\Migration;

/**
 * Class m200126_235309_divide_statistics_views_by_branch
 */
class m200126_235309_divide_statistics_views_by_branch extends Migration
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
                `branch_id`,
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
        
        $this->execute("
        CREATE OR REPLACE VIEW `v_sales_grouped_amounts`
        AS
            SELECT `branch_id`, 'day' AS `type`, `day` AS `value`, SUM(`amount`) AS `amount`, SUM(`profit`) AS `profit` FROM `v_sales_daily_amounts` GROUP BY `day`, `branch_id`
            UNION ALL
            SELECT `branch_id`, 'week' AS `type`, `week` AS `value`, SUM(`amount`) AS `amount`, SUM(`profit`) AS `profit` FROM `v_sales_daily_amounts` GROUP BY `week`, `branch_id`
            UNION ALL
            SELECT `branch_id`, 'month' AS `type`, `month` AS `value`, SUM(`amount`) AS `amount`, SUM(`profit`) AS `profit` FROM `v_sales_daily_amounts` GROUP BY `month`, `branch_id`
            UNION ALL
            SELECT `branch_id`, 'year' AS `type`, `year` AS `value`, SUM(`amount`) AS `amount`, SUM(`profit`) AS `profit` FROM `v_sales_daily_amounts` GROUP BY `year`, `branch_id`
            "
        );
        
        $this->execute("CREATE OR REPLACE VIEW `v_sold_products_per_sale`
        AS
        SELECT
            `branch_id`,
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
            "
        );
        
        $this->execute("
        CREATE OR REPLACE VIEW `v_sold_products_amounts`
        AS
            SELECT `branch_id`, 'day' AS `type`, `day` AS `value`, `product`, SUM(`sold_items`) AS `sold_items` FROM `v_sold_products_per_sale` GROUP BY `day`,`product`, `branch_id`
            UNION ALL
            SELECT `branch_id`, 'week' AS `type`, `week` AS `value`, `product`, SUM(`sold_items`) AS `sold_items` FROM `v_sold_products_per_sale` GROUP BY `week`,`product`, `branch_id`
            UNION ALL
            SELECT `branch_id`, 'month' AS `type`, `month` AS `value`, `product`, SUM(`sold_items`) AS `sold_items` FROM `v_sold_products_per_sale` GROUP BY `month`,`product`, `branch_id`
            UNION ALL
            SELECT `branch_id`, 'year' AS `type`, `year` AS `value`, `product`, SUM(`sold_items`) AS `sold_items` FROM `v_sold_products_per_sale` GROUP BY `year`,`product`, `branch_id`
            ORDER BY `type` ASC, `sold_items` DESC
            "
        );
        
        $this->execute("
        CREATE OR REPLACE VIEW `v_workshop_daily_amounts`
        AS
        SELECT
            `branch_id`,
            DATE(`date_closed`) AS `day`,
            DATE_FORMAT(`date_closed`, '%Y-%u') AS `week`,
            DATE_FORMAT(`date_closed`, '%M %Y') AS `month`,
            YEAR(`date_closed`) AS `year`,
            `final_price` AS `amount`,
            `effort` + COALESCE((SELECT SUM(`price_out`) - SUM(`price_in`) FROM `workshop_pre_diagnosis` WHERE `workshop_id` = `w`.`id`), 0) AS `profit`
            FROM `workshop` `w`
            WHERE `w`.`status` = 1
            "
        );
        
        $this->execute("
        CREATE OR REPLACE VIEW `v_workshop_grouped_amounts`
        AS
            SELECT `branch_id`, 'day' AS `type`, `day` AS `value`, SUM(`amount`) AS `amount`, SUM(`profit`) AS `profit` FROM `v_workshop_daily_amounts` GROUP BY `day`, `branch_id`
            UNION ALL
            SELECT `branch_id`, 'week' AS `type`, `week` AS `value`, SUM(`amount`) AS `amount`, SUM(`profit`) AS `profit` FROM `v_workshop_daily_amounts` GROUP BY `week`, `branch_id`
            UNION ALL
            SELECT `branch_id`, 'month' AS `type`, `month` AS `value`, SUM(`amount`) AS `amount`, SUM(`profit`) AS `profit` FROM `v_workshop_daily_amounts` GROUP BY `month`, `branch_id`
            UNION ALL
            SELECT `branch_id`, 'year' AS `type`, `year` AS `value`, SUM(`amount`) AS `amount`, SUM(`profit`) AS `profit` FROM `v_workshop_daily_amounts` GROUP BY `year`, `branch_id`
            "
        );
        
        $this->execute("
        CREATE OR REPLACE VIEW `v_sales_current_info`
        AS
            SELECT `branch_id`, 'day' AS `type`, amount, profit from v_sales_grouped_amounts sa inner join v_current_date cd on (sa.type = 'day' and sa.value = cd.day)
            UNION ALL
            SELECT `branch_id`, 'week' AS `type`,  amount, profit from v_sales_grouped_amounts sa inner join v_current_date cd on (sa.type = 'week' and sa.value = cd.week)
            UNION ALL
            SELECT `branch_id`, 'month' AS `type`,  amount, profit from v_sales_grouped_amounts sa inner join v_current_date cd on (sa.type = 'month' and sa.value = cd.month)
            UNION ALL
            SELECT `branch_id`, 'year' AS `type`,  amount, profit from v_sales_grouped_amounts sa inner join v_current_date cd on (sa.type = 'year' and sa.value = cd.year)
            "
        );
        
        $this->execute("
        CREATE OR REPLACE VIEW `v_workshop_current_info`
        AS
            SELECT `branch_id`, 'day' AS `type`, amount, profit from v_workshop_grouped_amounts sa inner join v_current_date cd on (sa.type = 'day' and sa.value = cd.day)
            UNION ALL
            SELECT `branch_id`, 'week' AS `type`,  amount, profit from v_workshop_grouped_amounts sa inner join v_current_date cd on (sa.type = 'week' and sa.value = cd.week)
            UNION ALL
            SELECT `branch_id`, 'month' AS `type`,  amount, profit from v_workshop_grouped_amounts sa inner join v_current_date cd on (sa.type = 'month' and sa.value = cd.month)
            UNION ALL
            SELECT `branch_id`, 'year' AS `type`,  amount, profit from v_workshop_grouped_amounts sa inner join v_current_date cd on (sa.type = 'year' and sa.value = cd.year)
            "
        );
        
        $this->execute("
        CREATE OR REPLACE VIEW `v_sold_products_current_info`
        AS
            SELECT `branch_id`, 'day' AS `type`, `product`, `sold_items` from v_sold_products_amounts sa inner join v_current_date cd on (sa.type = 'day' and sa.value = cd.day)
            UNION ALL
            SELECT `branch_id`, 'week' AS `type`, `product`, `sold_items` from v_sold_products_amounts sa inner join v_current_date cd on (sa.type = 'week' and sa.value = cd.week)
            UNION ALL
            SELECT `branch_id`, 'month' AS `type`, `product`, `sold_items` from v_sold_products_amounts sa inner join v_current_date cd on (sa.type = 'month' and sa.value = cd.month)
            UNION ALL
            SELECT `branch_id`, 'year' AS `type`, `product`, `sold_items` from v_sold_products_amounts sa inner join v_current_date cd on (sa.type = 'year' and sa.value = cd.year)
            ORDER BY `sold_items` DESC
            "
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200126_235309_divide_statistics_views_by_branch cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200126_235309_divide_statistics_views_by_branch cannot be reverted.\n";

        return false;
    }
    */
}
