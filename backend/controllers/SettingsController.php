<?php

namespace backend\controllers;

use common\models\AppConfig;
use Yii;
use yii\web\NotFoundHttpException;

/**
 * SettingsController implements the CRUD actions for AppConfig model.
 */
class SettingsController extends GenericController {

    public function beforeAction($action) {
        $this->entityId = 'app-config';
        Yii::$app->view->params['active'] = $this->entityId;
        return parent::beforeAction($action);
    }

    /**
     * Lists all AppConfig models.
     * @return mixed
     */
    public function actionIndex() {
        return $this->render('view', ['model' => $this->findModel(1)]);
    }

    /**
     * Updates an existing AppConfig model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', ['model' => $model,
        ]);
    }

    /**
     * Deletes an existing AppConfig model.
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
     * Finds the AppConfig model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AppConfig the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = AppConfig::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

}
