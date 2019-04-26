<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $auth_key
 * @property string $first_name
 * @property string $last_name
 * @property string $telephone
 * @property string $address
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $sex
 * @property int $status
 * @property int $branch_id
 * @property int $created_at
 * @property int $updated_at
 * @property string $user_data
 *
 * @property Branch $branch
 * @property Workshop[] $workshops
 */
class UserDB extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
                [['username', 'auth_key', 'first_name', 'address', 'password_hash', 'email', 'created_at', 'updated_at', 'user_data'], 'required'],
                [['status', 'branch_id', 'created_at', 'updated_at'], 'integer'],
                [['user_data'], 'string'],
                [['username', 'first_name', 'last_name', 'email'], 'string', 'max' => 50],
                [['auth_key'], 'string', 'max' => 32],
                [['telephone', 'password_hash', 'password_reset_token'], 'string', 'max' => 255],
                [['address'], 'string', 'max' => 250],
                [['sex'], 'string', 'max' => 1],
                [['username'], 'unique'],
                [['email'], 'unique'],
                [['password_reset_token'], 'unique'],
                [['branch_id'], 'exist', 'skipOnError' => true, 'targetClass' => Branch::className(), 'targetAttribute' => ['branch_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'auth_key' => 'Auth Key',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'telephone' => 'Telephone',
            'address' => 'Address',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'sex' => 'Sex',
            'status' => 'Status',
            'branch_id' => 'Branch ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'user_data' => 'User Data',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBranch() {
        return $this->hasOne(Branch::className(), ['id' => 'branch_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorkshops() {
        return $this->hasMany(Workshop::className(), ['receiver_id' => 'id']);
    }

}
