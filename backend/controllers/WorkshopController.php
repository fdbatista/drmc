<?php

namespace backend\controllers;

use common\models\search\WorkshopPaymentSearch;
use common\models\search\WorkshopSearch;
use common\models\Workshop;
use common\models\WorkshopPayment;
use Yii;
use yii\web\NotFoundHttpException;

/**
 * WorkshopController implements the CRUD actions for Workshop model.
 */
class WorkshopController extends GenericController {

    public function beforeAction($action) {
        $this->entityId = 'workshop';
        Yii::$app->view->params['active'] = $this->entityId;
        return parent::beforeAction($action);
    }

    /**
     * Lists all Workshop models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new WorkshopSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        //$dataProvider->getSort()->defaultOrder = ['updated_at' => SORT_DESC];
        $dataProvider->getSort()->defaultOrder = ['updated_at' => SORT_DESC];

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Workshop model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Workshop model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Workshop();
        $model->receiver_id = Yii::$app->user->identity->id;
        $post = Yii::$app->request->post();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('create', ['model' => $model, 'passwordOrPattern' => $model->password ? 1 : 2]);
    }

    /**
     * Updates an existing Workshop model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('update', ['model' => $model, 'passwordOrPattern' => $model->password ? 1 : 2]);
    }

    /**
     * Deletes an existing Workshop model.
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
     * Finds the Workshop model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Workshop the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Workshop::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    //--------------Payments----------------

    /**
     * Lists all WorkshopPayment models.
     * @return mixed
     */
    public function actionIndexPayments($id) {
        $searchModel = new WorkshopPaymentSearch();
        $searchModel->workshop_id = $id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index-payments', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single WorkshopPayment model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionViewPayments($id) {
        return $this->render('view-payments', [
                    'model' => $this->findPaymentModel($id),
        ]);
    }

    /**
     * Creates a new WorkshopPayment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreatePayments($id) {
        $model = new WorkshopPayment();
        $model->workshop_id = $id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view-payments', 'id' => $model->id]);
        }

        $model->date = date('Y-m-d');

        return $this->render('create-payments', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing WorkshopPayment model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdatePayments($id) {
        $model = $this->findPaymentModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view-payments', 'id' => $model->id]);
        }

        return $this->render('update-payments', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing WorkshopPayment model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDeletePayments($id) {
        $model = $this->findPaymentModel($id);
        $workshopId = $model->getWorkshop()->one()->id;
        $model->delete();
        return $this->actionIndexPayments($workshopId);
    }

    /**
     * Finds the WorkshopPayment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return WorkshopPayment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findPaymentModel($id) {
        if (($model = WorkshopPayment::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

}
