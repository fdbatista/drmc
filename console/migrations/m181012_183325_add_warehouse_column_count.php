<?php

use yii\db\Migration;

/**
 * Class m181012_183325_add_warehouse_column_count
 */
class m181012_183325_add_warehouse_column_count extends Migration {

    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $this->addColumn('warehouse', 'items', 'integer not null');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        echo "m181012_183325_add_warehouse_column_count cannot be reverted.\n";

        return false;
    }

    /*
      // Use up()/down() to run migration code without a transaction.
      public function up()
      {

      }

      public function down()
      {
      echo "m181012_183325_add_warehouse_column_count cannot be reverted.\n";

      return false;
      }
     */
}
