<?php

use yii\db\Migration;

/**
 * Handles the creation of table `brand`.
 */
class m181008_221425_create_brand_table extends Migration {

    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $this->createTable('brand', [
            'id' => $this->primaryKey(),
            'name' => $this->string(75)->notNull()->unique(),
            'description' => $this->string(250),
                ], ($this->db->driverName === 'mysql') ? 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB' : null);
        
        $this->insert('brand', ['name' => 'Samsung']);
        $this->insert('brand', ['name' => 'Apple']);
        $this->insert('brand', ['name' => 'Alcatel']);
        $this->insert('brand', ['name' => 'Huawei']);
        $this->insert('brand', ['name' => 'BLU']);
        $this->insert('brand', ['name' => 'Acer']);
        $this->insert('brand', ['name' => 'Xiaomi']);
        $this->insert('brand', ['name' => 'Lenovo']);
        $this->insert('brand', ['name' => 'LG']);
        $this->insert('brand', ['name' => 'Sony']);
        $this->insert('brand', ['name' => 'Nokia']);
        $this->insert('brand', ['name' => 'Microsoft']);
        $this->insert('brand', ['name' => 'Motorola']);
        $this->insert('brand', ['name' => 'HTC']);
        $this->insert('brand', ['name' => 'BlackBerry']);
        $this->insert('brand', ['name' => 'Asus']);
        $this->insert('brand', ['name' => 'Meizu']);
        $this->insert('brand', ['name' => 'ZTE']);
        $this->insert('brand', ['name' => 'Lanix']);
        $this->insert('brand', ['name' => 'Oppo']);
        $this->insert('brand', ['name' => 'Sony Ericsson']);
        $this->insert('brand', ['name' => 'Orange']);
        $this->insert('brand', ['name' => 'Vodafone']);
        $this->insert('brand', ['name' => 'Verykool']);
        $this->insert('brand', ['name' => 'Azumi']);
        $this->insert('brand', ['name' => 'Hyundai']);
        $this->insert('brand', ['name' => 'HP']);
        $this->insert('brand', ['name' => 'BGH']);
        $this->insert('brand', ['name' => 'Dell']);
        $this->insert('brand', ['name' => 'Pantech']);
        $this->insert('brand', ['name' => 'OnePlus']);
        $this->insert('brand', ['name' => 'Philips']);
        $this->insert('brand', ['name' => 'Cat']);
        $this->insert('brand', ['name' => 'Palm']);
        $this->insert('brand', ['name' => 'TCL']);
        $this->insert('brand', ['name' => 'Movistar']);
        $this->insert('brand', ['name' => 'Yezz']);
        $this->insert('brand', ['name' => 'Siemens']);
        $this->insert('brand', ['name' => 'Amazon']);
        $this->insert('brand', ['name' => 'Panasonic']);
        $this->insert('brand', ['name' => 'bq']);
        $this->insert('brand', ['name' => 'Sagem']);
        $this->insert('brand', ['name' => 'NEC']);
        $this->insert('brand', ['name' => 'Qtek']);
        $this->insert('brand', ['name' => 'Sharp']);
        $this->insert('brand', ['name' => 'Toshiba']);
        $this->insert('brand', ['name' => 'Cect']);
        $this->insert('brand', ['name' => 'Google']);
        $this->insert('brand', ['name' => 'i-mate']);
        $this->insert('brand', ['name' => 'i-mobile']);
        $this->insert('brand', ['name' => 'Vertu']);
        $this->insert('brand', ['name' => 'Skyzen']);
        $this->insert('brand', ['name' => 'Haier']);
        $this->insert('brand', ['name' => 'BenQ']);
        $this->insert('brand', ['name' => 'O2']);
        $this->insert('brand', ['name' => 'Gigabyte']);
        $this->insert('brand', ['name' => 'Eten']);
        $this->insert('brand', ['name' => 'Bird']);
        $this->insert('brand', ['name' => 'Amoi']);
        $this->insert('brand', ['name' => 'BenQ Siemens']);
        $this->insert('brand', ['name' => 'Gradiente']);
        $this->insert('brand', ['name' => 'Modu']);
        $this->insert('brand', ['name' => 'Geeksphone']);
        $this->insert('brand', ['name' => 'Anycool']);
        $this->insert('brand', ['name' => 'Wiko']);
        $this->insert('brand', ['name' => 'LeEco']);
        $this->insert('brand', ['name' => 'iNQ']);
        $this->insert('brand', ['name' => 'Telit']);
        $this->insert('brand', ['name' => 'Airam']);
        $this->insert('brand', ['name' => 'Obi Worldphone']);
        $this->insert('brand', ['name' => 'AEG']);
        $this->insert('brand', ['name' => 'Suzuki']);
        $this->insert('brand', ['name' => 'Jolla']);
        $this->insert('brand', ['name' => 'Coolpad']);
        $this->insert('brand', ['name' => 'General Mobile']);
        $this->insert('brand', ['name' => 'Vivo']);
        $this->insert('brand', ['name' => 'ViewSonic']);
        $this->insert('brand', ['name' => 'Quantum']);
        $this->insert('brand', ['name' => 'Mac']);
        $this->insert('brand', ['name' => 'Alienware']);
        $this->insert('brand', ['name' => 'Gateway']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->dropTable('brand');
    }

}
