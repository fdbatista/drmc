<?php

use yii\db\Migration;

/**
 * Class m200131_042224_set_timezone_mex_in_curr_date_view
 */
class m200131_042224_set_timezone_mex_in_curr_date_view extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
        CREATE OR REPLACE VIEW `v_current_date`
        AS
        SELECT
            DATE(DATE_SUB(CURRENT_DATE(), INTERVAL 3 HOUR)) AS `day`,
            DATE_FORMAT(CURRENT_DATE(), '%Y-%u') AS `week`,
            DATE_FORMAT(CURRENT_DATE(), '%M %Y') AS `month`,
            YEAR(CURRENT_DATE()) AS `year`
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200131_042224_set_timezone_mex_in_curr_date_view cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200131_042224_set_timezone_mex_in_curr_date_view cannot be reverted.\n";

        return false;
    }
    */
}
