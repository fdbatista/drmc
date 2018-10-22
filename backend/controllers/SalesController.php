<?php

namespace backend\controllers;

use common\models\Customer;
use common\models\Sale;
use common\models\SaleItem;
use common\models\search\SaleItemSearch;
use common\models\search\SaleSearch;
use common\models\Shop;
use common\models\Warehouse;
use Yii;
use yii\web\NotFoundHttpException;

/**
 * SalesController implements the CRUD actions for Sale model.
 */
class SalesController extends GenericController {

    public function beforeAction($action) {
        $this->entityId = 'sales';
        Yii::$app->view->params['active'] = $this->entityId;
        return parent::beforeAction($action);
    }

    /**
     * Lists all Sale models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new SaleSearch();
        $pp = Yii::$app->request->queryParams;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->getSort()->defaultOrder = ['date' => SORT_DESC];

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Sale model.
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
     * Creates a new Sale model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Sale();
        $post = Yii::$app->request->post();
        if (count($post) > 0) {
            if (($post['client-type'] === '1' && $post['Sale']['client-code'] === '') || ($post['client-type'] === '2' && $post['Sale']['customer_id'] === '')) {
                $model->addError('customer_id', 'Debe asociar un cliente a la venta.');
            } else {
                if ($post['Sale']['customer_id'] === '') {
                    $customer = Customer::findOne(['code' => $post['Sale']['client-code']]);
                    $post['Sale']['customer_id'] = $customer->id;
                }
                if ($model->load($post) && $model->save()) {
                    return $this->actionIndexItems($model->id);
                }
            }
        }
        $model->date = date('Y-m-d H:i');
        return $this->render('create', ['model' => $model]);
    }

    /**
     * Updates an existing Sale model.
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
        return $this->render('update', ['model' => $model]);
    }

    /**
     * Deletes an existing Sale model.
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
     * Finds the Sale model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Sale the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Sale::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    //--------------------Items-------------------------

    /**
     * Lists all SaleItem models.
     * @return mixed
     */
    public function actionIndexItems($id) {
        $searchModel = new SaleItemSearch();
        $searchModel->sale_id = $id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index-items', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SaleItem model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionViewItems($id) {
        return $this->render('view-items', [
                    'model' => $this->findItemsModel($id),
        ]);
    }

    /**
     * Creates a new SaleItem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreateItems($id) {
        $model = new SaleItem();
        $model->sale_id = $id;

        if ($model->load(Yii::$app->request->post())) {
            $found = false;
            $stock = Shop::findOne(['type_id' => $model->type_id, 'model_id' => $model->model_id]);
            if ($stock) {
                $found = true;
                if ($stock->items < $model->items) {
                    $model->addError('items', 'Solo existen ' . $stock->items . ' unidades de este producto en la tienda.');
                }
            } else {
                $stock = Warehouse::findOne(['type_id' => $model->type_id, 'model_id' => $model->model_id]);
                if ($stock) {
                    $found = true;
                    if ($stock->items < $model->items) {
                        $model->addError('items', 'Solo existen ' . $stock->items . ' unidades de este producto en la tienda.');
                    }
                }
            }
            if (!$found) {
                $model->addError('type_id', 'No existen artículos en tienda o almacén con ese tipo/modelo');
            }
            if (!$model->hasErrors()) {
                $model->price_in = $stock->price_in;
                $model->price_out = $stock->price_out;
                $model->save();
                $stock->items -= $model->items;
                if ($stock->items === 0) {
                    $stock->delete();
                } else {
                    $stock->save();
                }
                return $this->redirect(['view', 'id' => $id]);
            }
        }

        return $this->render('create-items', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing SaleItem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdateItems($id) {
        $model = $this->findItemsModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view-items', 'id' => $model->id]);
        }

        return $this->render('update-items', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing SaleItem model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDeleteItems($id) {
        $model = $this->findItemsModel($id);
        $parent_id = $model->sale_id;
        $model->delete();
        return $this->actionIndexItems($parent_id);
    }

    /**
     * Finds the SaleItem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SaleItem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findItemsModel($id) {
        if (($model = SaleItem::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

}
