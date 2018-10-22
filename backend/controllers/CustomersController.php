<?php

namespace backend\controllers;

use common\models\Customer;
use yii\rest\ActiveController;

class CustomersController extends ActiveController {
    
    public $modelClass = 'common\models\Customer';

    public function actionGenerateNewCustomer() {
        $customer = new Customer();
        $customer->save();
        $code = str_pad($customer->id, 11, '0', STR_PAD_LEFT);
        $customer->code = "CN-$code";
        $customer->save();
        return $customer->code;
    }

    public function actionIndex() {
        return $this->render('index');
    }

}
