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
class User extends ActiveRecord implements IdentityInterface {

    private CONST STATUS_ACTIVE = 10;
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
    public function attributeLabels() {
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
    public function getBranch() {
        return $this->hasOne(Branch::className(), ['id' => 'branch_id']);
    }

    public static function isPasswordResetTokenValid($token) {
        if (empty($token)) {
            return false;
        }
        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @return ActiveQuery
     */
    public function getWorkshops() {
        return $this->hasMany(Workshop::className(), ['receiver_id' => 'id']);
    }

    public function getAuthKey(): string {
        return $this->auth_key;
    }

    public function getId() {
        return $this->getPrimaryKey();
    }

    public function validateAuthKey($authKey) {
        return $this->getAuthKey() === $authKey;
    }

    public static function findIdentity($id) {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    public static function findIdentityByAccessToken($token, $type = null) {
        return User::findOne(['auth_key' => $token]);
    }

    public static function findByUsername($username) {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    public static function findByPasswordResetToken($token) {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }
        return static::findOne([
                    'password_reset_token' => $token,
                    'status' => self::STATUS_ACTIVE,
        ]);
    }

    public function validatePassword($password) {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }
    
    public function validatePasswordInput() {
        $this->validate();
        if ($this->getIsNewRecord()) {
            if (!$this->password) {
                $this->addError('password', 'Debe especificar una contraseña');
            } elseif ($this->password !== $this->password_repeat) {
                $this->addError('password_repeat', 'Las contraseñas no coinciden');
            }
        } else {
            if ($this->password && $this->password !== $this->password_repeat) {
                $this->addError('password_repeat', 'Las contraseñas no coinciden');
            }
        }
    }

    public function getUserData($key) {
        return $this->user_data[$key];
    }

    public function getFullName() {
        return "{$this->first_name} {$this->last_name}";
    }

    public function getRole() {
        $roles = Yii::$app->authManager->getRolesByUser($this->id);
        foreach ($roles as $key => $value) {
            return $key;
        }
        return 'tecnico';
    }

    public function getRoleObject() {
        $roles = Yii::$app->authManager->getRolesByUser($this->id);
        foreach ($roles as $role) {
            return $role;
        }
        return null;
    }

    public function getRoleDescription() {
        $roles = Yii::$app->authManager->getRolesByUser($this->id);
        foreach ($roles as $key => $value) {
            return "$key ($value->description)";
        }
        return null;
    }

    public function setUserData($key, $value) {
        $this->user_data[$key] = $value;
    }

    public function removePasswordResetToken() {
        $this->password_reset_token = null;
    }

    public function generatePasswordResetToken() {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    public function generateAuthKey() {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    public function setPassword($password) {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

}
