<?php

namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class Role extends Model {

    public $name;
    public $description;

    public function rules() {
        return [
                [['name', 'description'], 'required'],
                ['name', 'string', 'length' => [3, 25]],
                ['description', 'string', 'length' => [3, 150]],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validateName() {
        if (!$this->hasErrors()) {
            $authManager = Yii::$app->authManager;
            if ($authManager->getRole($this->name)) {
                $this->addError('name', 'Ya existe un rol con ese nombre');
                return false;
            }
            return true;
        }
        return false;
    }

}
