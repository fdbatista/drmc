<?php

namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

/**
 * BrandsController implements the CRUD actions for Model.
 */
class GenericController extends Controller {

    protected $entityId = '';
    
    public function beforeAction($action) {
        $timeZone = Yii::$app->user->isGuest ? null : Yii::$app->user->identity->getUserData('time_zone');
        date_default_timezone_set($timeZone ? $timeZone : 'America/Havana');
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
                        'actions' => ['set-items', 'get-available-items-for-sale', 'select-branch', 'get-brand-models-for-sale', 'calculate-price-with-discounts', 'get-warehouse-items-by-brand-model', 'get-pre-diagnosis-items'],
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
