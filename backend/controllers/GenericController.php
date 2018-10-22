<?php

namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

/**
 * BrandsController implements the CRUD actions for Modelo.
 */
class GenericController extends Controller {

    protected $entityId = '';

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                        [
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            $permissionName = "$action->id-$this->entityId";
                            $res = Yii::$app->user->can($permissionName);
                            return $res;
                        }
                    ],
                ],
            ]
        ];
    }
    
}