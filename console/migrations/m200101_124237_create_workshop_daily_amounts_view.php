<?php

use yii\db\Migration;

/**
 * Class m200101_124237_create_workshop_daily_amounts_view
 */
class m200101_124237_create_workshop_daily_amounts_view extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
        CREATE OR REPLACE VIEW `v_workshop_daily_amounts`
        AS
        SELECT
            DATE(`date_closed`) AS `day`,
            DATE_FORMAT(`date_closed`, '%Y-%u') AS `week`,
            DATE_FORMAT(`date_closed`, '%M %Y') AS `month`,
            YEAR(`date_closed`) AS `year`,
            `final_price` AS `amount`,
            `effort` + (SELECT SUM(`price_out`) - SUM(`price_in`) FROM `workshop_pre_diagnosis` WHERE `workshop_id` = `w`.`id`) AS `profit`
            FROM `workshop` `w`
            WHERE `w`.`status` = 1"
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200101_124237_create_workshop_daily_amounts_view cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200101_124237_create_workshop_daily_amounts_view cannot be reverted.\n";

        return false;
    }
    */
}
