<?php

namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
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
 * @property string $user_data
 *
 * @property Branch $branch
 * @property Workshop[] $workshops
 */
class User extends ActiveRecord implements IdentityInterface {

    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;

    public $password;
    public $password_repeat;

    //public $role;

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return '{{%user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
                [['username', 'auth_key', 'first_name', 'address', 'password_hash', 'email', 'created_at', 'updated_at'], 'required'],
                [['status', 'branch_id', 'created_at', 'updated_at'], 'integer'],
                [['username', 'first_name', 'last_name', 'email'], 'string', 'max' => 50],
                [['auth_key'], 'string', 'max' => 32],
                [['telephone', 'password_hash', 'password_reset_token'], 'string', 'max' => 255],
                [['address'], 'string', 'max' => 250],
                [['sex'], 'string', 'max' => 1],
                [['username'], 'unique'],
                [['email'], 'unique'],
                [['password_reset_token'], 'unique'],
                ['email', 'email'],
                ['status', 'in', 'range' => [self::STATUS_DELETED, self::STATUS_ACTIVE]],
                ['status', 'required'],
                [['password', 'password_repeat'], 'safe'],
                [['branch_id'], 'exist', 'skipOnError' => true, 'targetClass' => Branch::className(), 'targetAttribute' => ['branch_id' => 'id']],
        ];
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

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id) {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null) {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username) {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token) {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
                    'password_reset_token' => $token,
                    'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token) {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * {@inheritdoc}
     */
    public function getId() {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey() {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey) {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password) {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password) {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey() {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken() {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken() {
        $this->password_reset_token = null;
    }

    public function getFullName() {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorkshops() {
        return $this->hasMany(Workshop::className(), ['receiver_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBranch() {
        return $this->hasOne(Branch::className(), ['id' => 'branch_id']);
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
    
    public function getUserData($key = null) {
        $jsonData = json_decode($this->user_data, true);
        if ($key) {
            return $jsonData[$key];
        }
        return $jsonData;
    }
    
    public function setUserData($key, $value) {
        $jsonData = $this->getUserData();
        $jsonData[$key] = $value;
        $strData = json_encode($jsonData);
        $this->user_data = $strData;
    }

}
