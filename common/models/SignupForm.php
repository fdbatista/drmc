<?php

namespace common\models;

use Yii;

class SignupForm extends \yii\base\Model {

    public $username;
    public $status;
    public $password;
    public $passwordConfirm;
    public $email;
    public $role;

    public function rules() {
        return [
                [['username', 'password', 'passwordConfirm', 'email', 'role'], 'required'],
                ['status', 'integer'],
                ['email', 'email'],
                'password' => [['password'], 'string', 'max' => 10, 'min' => 3],
        ];
    }

}
