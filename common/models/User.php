<?php

namespace common\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

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
 * @property array $user_data
 *
 * @property Branch $branch
 * @property Workshop[] $workshops
 */
class User extends ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'auth_key', 'first_name', 'address', 'password_hash', 'email', 'created_at', 'updated_at'], 'required'],
            [['status', 'branch_id', 'created_at', 'updated_at'], 'integer'],
            [['user_data'], 'safe'],
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
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Username'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'first_name' => Yii::t('app', 'First Name'),
            'last_name' => Yii::t('app', 'Last Name'),
            'telephone' => Yii::t('app', 'Telephone'),
            'address' => Yii::t('app', 'Address'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'password_reset_token' => Yii::t('app', 'Password Reset Token'),
            'email' => Yii::t('app', 'Email'),
            'sex' => Yii::t('app', 'Sex'),
            'status' => Yii::t('app', 'Status'),
            'branch_id' => Yii::t('app', 'Branch ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'user_data' => Yii::t('app', 'User Data'),
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getBranch()
    {
        return $this->hasOne(Branch::className(), ['id' => 'branch_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getWorkshops()
    {
        return $this->hasMany(Workshop::className(), ['receiver_id' => 'id']);
    }

    public function getAuthKey(): string {
        return $this->auth_key;
    }

    public function getId() {
        return $this->id;
    }

    public function validateAuthKey($authKey): bool {
        return $this->auth_key === $authKey;
    }

    public static function findIdentity($id) {
        return User::findOne($id);
    }
    
    public static function findIdentityByAccessToken($token, $type = null) {
        return User::findOne(['auth_key' => $token]);
    }
    
    public static function findByUsername($username) {
        return User::findOne(['username' => $username]);
    }
    
    public function validatePassword($password) {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }
    
    public function getUserData($key) {
        return $this->user_data[$key];
    }
    
    public function getFullName() {
        return "{$this->first_name} {$this->last_name}";
    }

}
