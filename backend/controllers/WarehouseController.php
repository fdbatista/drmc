<?php

namespace backend\controllers;

use common\models\search\StockSearch;
use common\models\Shop;
use common\models\Stock;
use Yii;
use yii\web\NotFoundHttpException;

/**
 * ShopController implements the CRUD actions for Stock model.
 */
class WarehouseController extends GenericController {

    public function beforeAction($action) {
        if (!Yii::$app->user->isGuest && !Yii::$app->session->get('branch_id')) {
            return $this->redirect(['/']);
        }
        $this->entityId = 'warehouse';
        Yii::$app->view->params['active'] = $this->entityId;
        return parent::beforeAction($action);
    }

    /**
     * Lists all Shop models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new StockSearch(['stock_type_id' => 2, 'branch_id' => Yii::$app->session->get('branch_id')]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->getSort()->defaultOrder = ['updated_at' => SORT_DESC];

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Shop model.
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
     * Creates a new Shop model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Stock(['branch_id' => Yii::$app->session->get('branch_id'), 'stock_type_id' => 2, 'first_discount' => 0.00, 'major_discount' => 0.00]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }
        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing Shop model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $model->branch_id = Yii::$app->session->get('branch_id');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Shop model.
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
     * Finds the Shop model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Shop the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Stock::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

}
