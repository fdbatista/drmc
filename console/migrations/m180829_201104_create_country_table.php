<?php

use yii\db\Migration;

/**
 * Handles the creation of table `country`.
 */
class m180829_201104_create_country_table extends Migration {

    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $this->createTable('country', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique(),
                ], ($this->db->driverName === 'mysql') ? 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB' : null);
        $this->insert('country', ['name' => 'Afghanistan']);
        $this->insert('country', ['name' => 'Albania']);
        $this->insert('country', ['name' => 'Algeria']);
        $this->insert('country', ['name' => 'Andorra']);
        $this->insert('country', ['name' => 'Angola']);
        $this->insert('country', ['name' => 'Antigua and Barbuda']);
        $this->insert('country', ['name' => 'Argentina']);
        $this->insert('country', ['name' => 'Armenia']);
        $this->insert('country', ['name' => 'Australia']);
        $this->insert('country', ['name' => 'Austria']);
        $this->insert('country', ['name' => 'Azerbaijan']);
        $this->insert('country', ['name' => 'Bahamas']);
        $this->insert('country', ['name' => 'Bahrain']);
        $this->insert('country', ['name' => 'Bangladesh']);
        $this->insert('country', ['name' => 'Barbados']);
        $this->insert('country', ['name' => 'Belarus']);
        $this->insert('country', ['name' => 'Belgium']);
        $this->insert('country', ['name' => 'Belize']);
        $this->insert('country', ['name' => 'Benin']);
        $this->insert('country', ['name' => 'Bermuda']);
        $this->insert('country', ['name' => 'Bhutan']);
        $this->insert('country', ['name' => 'Bolivia, Plurinational State of']);
        $this->insert('country', ['name' => 'Bosnia and Herzegovina']);
        $this->insert('country', ['name' => 'Botswana']);
        $this->insert('country', ['name' => 'Brazil']);
        $this->insert('country', ['name' => 'Brunei Darussalam']);
        $this->insert('country', ['name' => 'Bulgaria']);
        $this->insert('country', ['name' => 'Burkina Faso']);
        $this->insert('country', ['name' => 'Burundi']);
        $this->insert('country', ['name' => 'Cabo Verde']);
        $this->insert('country', ['name' => 'Cambodia']);
        $this->insert('country', ['name' => 'Cameroon']);
        $this->insert('country', ['name' => 'Canada']);
        $this->insert('country', ['name' => 'Cape Verde']);
        $this->insert('country', ['name' => 'Cayman Islands']);
        $this->insert('country', ['name' => 'Central African Republic']);
        $this->insert('country', ['name' => 'Chad']);
        $this->insert('country', ['name' => 'Chile']);
        $this->insert('country', ['name' => 'China']);
        $this->insert('country', ['name' => 'Colombia']);
        $this->insert('country', ['name' => 'Comoros']);
        $this->insert('country', ['name' => 'Congo, the Democratic Republic of the']);
        $this->insert('country', ['name' => 'Costa Rica']);
        $this->insert('country', ['name' => 'Côte d\'Ivoire']);
        $this->insert('country', ['name' => 'Croatia']);
        $this->insert('country', ['name' => 'Cuba']);
        $this->insert('country', ['name' => 'Cyprus']);
        $this->insert('country', ['name' => 'Czech Republic']);
        $this->insert('country', ['name' => 'Denmark']);
        $this->insert('country', ['name' => 'Djibouti']);
        $this->insert('country', ['name' => 'Dominica']);
        $this->insert('country', ['name' => 'Dominican Republic']);
        $this->insert('country', ['name' => 'Ecuador']);
        $this->insert('country', ['name' => 'Egypt']);
        $this->insert('country', ['name' => 'El Salvador']);
        $this->insert('country', ['name' => 'Equatorial Guinea']);
        $this->insert('country', ['name' => 'Eritrea']);
        $this->insert('country', ['name' => 'Estonia']);
        $this->insert('country', ['name' => 'Eswatini']);
        $this->insert('country', ['name' => 'Ethiopia']);
        $this->insert('country', ['name' => 'Faroe Islands']);
        $this->insert('country', ['name' => 'Federated States of Micronesia']);
        $this->insert('country', ['name' => 'Fiji']);
        $this->insert('country', ['name' => 'Finland']);
        $this->insert('country', ['name' => 'France']);
        $this->insert('country', ['name' => 'French Guiana']);
        $this->insert('country', ['name' => 'French Polynesia']);
        $this->insert('country', ['name' => 'Gabon']);
        $this->insert('country', ['name' => 'Gambia']);
        $this->insert('country', ['name' => 'Georgia']);
        $this->insert('country', ['name' => 'Germany']);
        $this->insert('country', ['name' => 'Ghana']);
        $this->insert('country', ['name' => 'Greece']);
        $this->insert('country', ['name' => 'Greenland']);
        $this->insert('country', ['name' => 'Grenada']);
        $this->insert('country', ['name' => 'Guadeloupe']);
        $this->insert('country', ['name' => 'Guam']);
        $this->insert('country', ['name' => 'Guatemala']);
        $this->insert('country', ['name' => 'Guinea']);
        $this->insert('country', ['name' => 'Guinea-Bissau']);
        $this->insert('country', ['name' => 'Guyana']);
        $this->insert('country', ['name' => 'Haiti']);
        $this->insert('country', ['name' => 'Holy See (Vatican City State)']);
        $this->insert('country', ['name' => 'Honduras']);
        $this->insert('country', ['name' => 'Hong Kong']);
        $this->insert('country', ['name' => 'Hungary']);
        $this->insert('country', ['name' => 'Iceland']);
        $this->insert('country', ['name' => 'India']);
        $this->insert('country', ['name' => 'Indonesia']);
        $this->insert('country', ['name' => 'Iran, Islamic Republic of']);
        $this->insert('country', ['name' => 'Iraq']);
        $this->insert('country', ['name' => 'Ireland']);
        $this->insert('country', ['name' => 'Israel']);
        $this->insert('country', ['name' => 'Italy']);
        $this->insert('country', ['name' => 'Jamaica']);
        $this->insert('country', ['name' => 'Japan']);
        $this->insert('country', ['name' => 'Jordan']);
        $this->insert('country', ['name' => 'Kazakhstan']);
        $this->insert('country', ['name' => 'Kenya']);
        $this->insert('country', ['name' => 'Kiribati']);
        $this->insert('country', ['name' => 'Korea, Democratic People\'s Republic of']);
        $this->insert('country', ['name' => 'Korea, Republic of']);
        $this->insert('country', ['name' => 'Kosovo']);
        $this->insert('country', ['name' => 'Kuwait']);
        $this->insert('country', ['name' => 'Kyrgyzstan']);
        $this->insert('country', ['name' => 'Lao People\'s Democratic Republic']);
        $this->insert('country', ['name' => 'Latvia']);
        $this->insert('country', ['name' => 'Lebanon']);
        $this->insert('country', ['name' => 'Lesotho']);
        $this->insert('country', ['name' => 'Liberia']);
        $this->insert('country', ['name' => 'Libya']);
        $this->insert('country', ['name' => 'Liechtenstein']);
        $this->insert('country', ['name' => 'Lithuania']);
        $this->insert('country', ['name' => 'Luxembourg']);
        $this->insert('country', ['name' => 'Macao']);
        $this->insert('country', ['name' => 'Macedonia, the Former Yugoslav Republic of']);
        $this->insert('country', ['name' => 'Madagascar']);
        $this->insert('country', ['name' => 'Malawi']);
        $this->insert('country', ['name' => 'Malaysia']);
        $this->insert('country', ['name' => 'Maldives']);
        $this->insert('country', ['name' => 'Mali']);
        $this->insert('country', ['name' => 'Malta']);
        $this->insert('country', ['name' => 'Marshall Islands']);
        $this->insert('country', ['name' => 'Martinique']);
        $this->insert('country', ['name' => 'Mauritania']);
        $this->insert('country', ['name' => 'Mauritius']);
        $this->insert('country', ['name' => 'Mexico']);
        $this->insert('country', ['name' => 'Moldova, Republic of']);
        $this->insert('country', ['name' => 'Monaco']);
        $this->insert('country', ['name' => 'Mongolia']);
        $this->insert('country', ['name' => 'Montenegro']);
        $this->insert('country', ['name' => 'Montserrat']);
        $this->insert('country', ['name' => 'Morocco']);
        $this->insert('country', ['name' => 'Mozambique']);
        $this->insert('country', ['name' => 'Myanmar']);
        $this->insert('country', ['name' => 'Namibia']);
        $this->insert('country', ['name' => 'Nauru']);
        $this->insert('country', ['name' => 'Nepal']);
        $this->insert('country', ['name' => 'Netherlands']);
        $this->insert('country', ['name' => 'New Caledonia']);
        $this->insert('country', ['name' => 'New Zealand']);
        $this->insert('country', ['name' => 'Nicaragua']);
        $this->insert('country', ['name' => 'Niger']);
        $this->insert('country', ['name' => 'Nigeria']);
        $this->insert('country', ['name' => 'Niue']);
        $this->insert('country', ['name' => 'Norway']);
        $this->insert('country', ['name' => 'Oman']);
        $this->insert('country', ['name' => 'Pakistan']);
        $this->insert('country', ['name' => 'Palau']);
        $this->insert('country', ['name' => 'Palestine, State of']);
        $this->insert('country', ['name' => 'Panama']);
        $this->insert('country', ['name' => 'Papua New Guinea']);
        $this->insert('country', ['name' => 'Paraguay']);
        $this->insert('country', ['name' => 'Peru']);
        $this->insert('country', ['name' => 'Philippines']);
        $this->insert('country', ['name' => 'Poland']);
        $this->insert('country', ['name' => 'Portugal']);
        $this->insert('country', ['name' => 'Puerto Rico']);
        $this->insert('country', ['name' => 'Qatar']);
        $this->insert('country', ['name' => 'Réunion']);
        $this->insert('country', ['name' => 'Romania']);
        $this->insert('country', ['name' => 'Russian Federation']);
        $this->insert('country', ['name' => 'Rwanda']);
        $this->insert('country', ['name' => 'Saint Kitts and Nevis']);
        $this->insert('country', ['name' => 'Saint Lucia']);
        $this->insert('country', ['name' => 'Saint Vincent and the Grenadines']);
        $this->insert('country', ['name' => 'Samoa']);
        $this->insert('country', ['name' => 'San Marino']);
        $this->insert('country', ['name' => 'São Tomé and Príncipe']);
        $this->insert('country', ['name' => 'Saudi Arabia']);
        $this->insert('country', ['name' => 'Senegal']);
        $this->insert('country', ['name' => 'Serbia']);
        $this->insert('country', ['name' => 'Seychelles']);
        $this->insert('country', ['name' => 'Sierra Leone']);
        $this->insert('country', ['name' => 'Singapore']);
        $this->insert('country', ['name' => 'Slovakia']);
        $this->insert('country', ['name' => 'Slovenia']);
        $this->insert('country', ['name' => 'Solomon Islands']);
        $this->insert('country', ['name' => 'Somalia']);
        $this->insert('country', ['name' => 'South Africa']);
        $this->insert('country', ['name' => 'South Sudan']);
        $this->insert('country', ['name' => 'Spain']);
        $this->insert('country', ['name' => 'Sri Lanka']);
        $this->insert('country', ['name' => 'Sudan']);
        $this->insert('country', ['name' => 'Suriname']);
        $this->insert('country', ['name' => 'Swaziland']);
        $this->insert('country', ['name' => 'Sweden']);
        $this->insert('country', ['name' => 'Switzerland']);
        $this->insert('country', ['name' => 'Syrian Arab Republic']);
        $this->insert('country', ['name' => 'Taiwan, Province of China']);
        $this->insert('country', ['name' => 'Tajikistan']);
        $this->insert('country', ['name' => 'Tanzania, United Republic of']);
        $this->insert('country', ['name' => 'Thailand']);
        $this->insert('country', ['name' => 'Timor-Leste']);
        $this->insert('country', ['name' => 'Togo']);
        $this->insert('country', ['name' => 'Tonga']);
        $this->insert('country', ['name' => 'Trinidad and Tobago']);
        $this->insert('country', ['name' => 'Tunisia']);
        $this->insert('country', ['name' => 'Turkey']);
        $this->insert('country', ['name' => 'Turkmenistan']);
        $this->insert('country', ['name' => 'Turks and Caicos Islands']);
        $this->insert('country', ['name' => 'Tuvalu']);
        $this->insert('country', ['name' => 'Uganda']);
        $this->insert('country', ['name' => 'Ukraine']);
        $this->insert('country', ['name' => 'United Arab Emirates']);
        $this->insert('country', ['name' => 'United Kingdom']);
        $this->insert('country', ['name' => 'United States of America']);
        $this->insert('country', ['name' => 'Uruguay']);
        $this->insert('country', ['name' => 'Uzbekistan']);
        $this->insert('country', ['name' => 'Vanuatu']);
        $this->insert('country', ['name' => 'Venezuela, Bolivarian Republic of']);
        $this->insert('country', ['name' => 'Viet Nam']);
        $this->insert('country', ['name' => 'Virgin Islands, British']);
        $this->insert('country', ['name' => 'Yemen']);
        $this->insert('country', ['name' => 'Zambia']);
        $this->insert('country', ['name' => 'Zimbabwe']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->dropTable('country');
    }

}
