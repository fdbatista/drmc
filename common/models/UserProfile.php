<?php

namespace common\models;

use Yii;
use yii\base\Model;

class UserProfile extends Model {

    private $id;
    public $username;
    public $email;
    public $first_name;
    public $last_name;
    public $telephone;
    public $address;
    public $status;
    public $password;
    public $password_repeat;
    public $role;

    public function rules() {
        return [
                [['username', 'password', 'email', 'first_name', 'last_name', 'status', 'role'], 'required'],
                [['username', 'password', 'email', 'first_name', 'last_name', 'password', 'password_repeat', 'telephone'], 'string', 'length' => [3, 50]],
                [['address'], 'string', 'max' => 250],
                ['password', 'validatePassword'],
                ['password', 'compare'],
                ['email', 'email'],
                [['status', 'created_at', 'updated_at'], 'integer'],
                ['status', 'in', 'range' => [0, 10]],
                [['username', 'email', 'password_reset_token'], 'unique'],
        ];
    }

    public function validatePassword($attribute, $params, $validator) {
        if ($this->id && !$this->password) {
            $this->addError('password', 'Debe especificar una contraseña');
        }
    }

    public function save() {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        }
        return false;
    }

}
