<?php

namespace backend\controllers;

use common\models\Customer;
use Exception;
use Yii;
use yii\rest\ActiveController;

class CustomersController extends ActiveController {

    public $modelClass = 'common\models\Customer';

    public function actionGenerateNewCustomer() {
        $customer = new Customer();
        $params = Yii::$app->request->get();
        $customer->name = $params['name'];
        $customer->telephone = $params['telephone'];
        $customer->save();
        $code = str_pad($customer->id, 11, '0', STR_PAD_LEFT);
        $customer->code = "CN-$code";
        if ($customer->save()) {
            return $customer->code;
        }
        throw new Exception('Ya existe un cliente con ese nombre y teléfono');
    }

    public function actionIndex() {
        return $this->render('index');
    }

}
