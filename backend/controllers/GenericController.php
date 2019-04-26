<?php

namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

/**
 * BrandsController implements the CRUD actions for Modelo.
 */
class GenericController extends Controller {

    protected $entityId = '';
    
    public function beforeAction($action) {
        date_default_timezone_set(\Yii::$app->user->identity->getUserData('time_zone'));
        return parent::beforeAction($action);
    }
    
    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['get-brand-models-for-sale', 'calculate-price-with-discounts', 'get-warehouse-items-by-brand-model', 'get-pre-diagnosis-items'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
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
