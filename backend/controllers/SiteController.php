<?php

namespace backend\controllers;

use common\models\Branch;
use common\models\LoginForm;
use common\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

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
                        'actions' => ['logout', 'index', 'profile'],
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
        return $this->render('dashboard');
    }
    
    public function actionSelectBranch() {
        return $this->render('select-branch');
    }

    public function actionProfile() {
        Yii::$app->view->params['active'] = 'profile';
        return $this->render('profile', ['model' => User::findOne(Yii::$app->user->identity->id)]);
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
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                        'model' => $model,
            ]);
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
