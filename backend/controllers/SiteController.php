<?php

namespace backend\controllers;

use common\models\Branch;
use common\models\LoginForm;
use common\models\User;
use common\models\VSalesCurrentInfo;
use common\models\VSalesGroupedAmounts;
use common\models\VSoldProductsCurrentInfo;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Response;

/**
 * Site controller
 */
class SiteController extends Controller {

    public $layout = 'main';

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                        [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                        [
                        'actions' => ['logout', 'index', 'profile', 'get-last-days-sales', 'get-last-weeks-sales', 'get-last-months-sales'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                        [
                        'actions' => ['set-branch'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                        [
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->can($action->id);
                        }
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionSetBranch($id) {
        Yii::$app->session->set('branch_id', $id);
        Yii::$app->session->set('branch_name', Branch::findOne($id)->name);
        return $this->redirect(['/site/index']);
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex() {
        return (Yii::$app->session->get('branch_id')) ? $this->actionViewDashboard() : $this->actionSelectBranch();
    }

    public function actionViewDashboard() {
        Yii::$app->view->params['active'] = 'dashboard';
        
        $data = [
            'sales' => [
                'currentInfo' => [
                    ['title' => 'Hoy', 'data' => VSalesCurrentInfo::findOne(['type' => 'day'])],
                    ['title' => 'Esta semana', 'data' => VSalesCurrentInfo::findOne(['type' => 'week'])],
                    ['title' => 'Este mes', 'data' => VSalesCurrentInfo::findOne(['type' => 'month'])],
                    ['title' => 'Este año', 'data' => VSalesCurrentInfo::findOne(['type' => 'year'])],
                ],
            ],
            'sold_products' => [
                ['title' => 'Hoy', 'id' => 'sold_today', 'data' => VSoldProductsCurrentInfo::find()->where(['type' => 'day'])->orderBy(['sold_items' => SORT_DESC])->all()],
                ['title' => 'Esta semana', 'id' => 'sold_this_week', 'data' => VSoldProductsCurrentInfo::find()->where(['type' => 'week'])->orderBy(['sold_items' => SORT_DESC])->all()],
                ['title' => 'Este mes', 'id' => 'sold_this_month', 'data' => VSoldProductsCurrentInfo::find()->where(['type' => 'month'])->orderBy(['sold_items' => SORT_DESC])->all()],
                ['title' => 'Este a&ntilde;o', 'id' => 'sold_this_year', 'data' => VSoldProductsCurrentInfo::find()->where(['type' => 'year'])->orderBy(['sold_items' => SORT_DESC])->all()],
            ]
        ];
        
        return $this->render('dashboard', ['data' => $data]);
    }
    
    public function actionGetLastDaysSales() {
        return $this->getLastPeriodSales("select substring(date_format(`value`, '%W'), 1, 3) `value`, `amount`, `profit` from `v_sales_grouped_amounts` where `type` = 'day' ", 7);
    }
    
    public function actionGetLastWeeksSales() {
        return $this->getLastPeriodSales("select `value`, `amount`, `profit` from `v_sales_grouped_amounts` where `type` = 'week' order by `value` desc", 4);
    }
    
    public function actionGetLastMonthsSales() {
        return $this->getLastPeriodSales("select substr(`value`, 1, 3) `value`, `amount`, `profit` from `v_sales_grouped_amounts` where `type` = 'month' order by `value` desc", 12);
    }
    
    private function getLastPeriodSales($sql, $limit) {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $salesInfo = VSalesGroupedAmounts::findBySql($sql)->limit($limit)->all();
        $result = ['highest_series' => 0, 'labels' => [], 'series' => []];
        foreach ($salesInfo as $saleInfo) {
            $result['labels'][] = $saleInfo['value'];
            
            $amount = intval($saleInfo['amount']);
            $result['series'][0][] = $amount;
            if ($amount > $result['highest_series']){
                $result['highest_series'] = $amount + 100;
            }
            
            $profit = intval($saleInfo['profit']);
            $result['series'][1][] = $profit;
            if ($profit > $result['highest_series']){
                $result['highest_series'] = $profit + 100;
            }
        }
        return $result;
    }

    public function actionSelectBranch() {
        return $this->render('select-branch');
    }

    public function actionProfile() {
        Yii::$app->view->params['active'] = 'profile';
        $model = User::findOne(Yii::$app->user->identity->id);
        $zones = timezone_identifiers_list();
        $locations = [];

        foreach ($zones as $zone) {
            $zoneExploded = explode('/', $zone);
            if (isset($zoneExploded[1])) {
                $area = str_replace('_', ' ', $zoneExploded[1]);
                if (!empty($zoneExploded[2])) {
                    $area = $area . ' (' . str_replace('_', ' ', $zoneExploded[2]) . ')';
                }
                $locations[$zoneExploded[0]][$zone] = $area; // Creates array(DateTimeZone => 'Friendly name')
            }
        }

        if ($model->load(Yii::$app->request->post())) {
            $timeZone = \Yii::$app->request->post('time_zone');
            $model->setUserData('time_zone', $timeZone);
            $model->save();
        }
        return $this->render('profile', ['model' => $model, 'timeZones' => $locations]);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin() {
        $this->layout = 'login';

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $user = Yii::$app->user->identity;
            $userBranch = $user->branch;
            if ($userBranch) {
                Yii::$app->session->set('branch_id', $userBranch->id);
                Yii::$app->session->set('branch_name', $userBranch->name);
            }
            return $this->goBack();
        } else {
            $model->password = '';
            return $this->render('login', ['model' => $model]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout() {
        Yii::$app->user->logout();
        return $this->goHome();
    }

}
