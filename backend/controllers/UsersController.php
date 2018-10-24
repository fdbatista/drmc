<?php

namespace backend\controllers;

use common\models\search\UserSearch;
use common\models\User;
use Yii;
use yii\web\NotFoundHttpException;

/**
 * UsersController implements the CRUD actions for User model.
 */
class UsersController extends GenericController {

    public function beforeAction($action) {
        $this->entityId = 'users';
        Yii::$app->view->params['active'] = $this->entityId;
        return parent::beforeAction($action);
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        return $this->render('view', ['model' => $this->findModel($id)]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new User();

        if ($model->load(Yii::$app->request->post())) {
            $model->generateAuthKey();
            $model->generatePasswordResetToken();
            $model->setPassword($model->password);
            $now = time();
            $model->created_at = $now;
            $model->updated_at = $now;
            $model->validatePasswordInput();
            if (!$model->hasErrors() && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', ['model' => $model, 'userRole' => 'tech']);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $authManager = Yii::$app->authManager;
        $post = Yii::$app->request->post();
        if ($model->load($post)) {
            $now = time();
            $model->updated_at = $now;
            $model->validatePasswordInput();
            if ($model->password) {
                $model->setPassword($model->password);
            }
            if (!$model->hasErrors() && $model->save()) {
                $role = $authManager->getRole($post['role']);
                $authManager->revokeAll($model->id);
                $authManager->assign($role, $model->id);
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        $roles = $authManager->getRoles();
        return $this->render('update', ['model' => $model, 'roles' => $roles]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

}
