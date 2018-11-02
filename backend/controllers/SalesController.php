<?php

namespace backend\controllers;

use common\models\BrandModel;
use common\models\Customer;
use common\models\DeviceType;
use common\models\Sale;
use common\models\SaleItem;
use common\models\search\SaleItemSearch;
use common\models\search\SaleSearch;
use common\models\Stock;
use common\utils\StaticMembers;
use Yii;
use yii\web\NotFoundHttpException;
use yii\web\Response;

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
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
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
        $model->items = 0;
        $model->price_out = 0;
        $model->discount_applied = 0;
        $model->final_price = 0;

        if ($model->load(Yii::$app->request->post())) {
            $stockModel = Stock::findOne(['device_type_id' => $model->device_type_id, 'brand_model_id' => $model->brand_model_id]);
            if ($stockModel) {
                if ($stockModel->items < $model->items) {
                    $model->addError('items', 'Solo existen ' . $stockModel->items . ' unidades disponibles de este producto.');
                }
                if ($model->discount_applied > 0 && (($model->discount_applied < $stockModel->first_discount * $model->items) || ($model->discount_applied > $stockModel->major_discount * $model->items))) {
                    $model->addError('discount_applied', 'El descuento aplicado debe ser un valor entre ' . $stockModel->first_discount * $model->items . ' y ' . $stockModel->major_discount * $model->items . '.');
                }
            } else {
                $model->addError('type_id', 'No existen dispositivos disponibles con ese tipo/modelo');
            }
            if (!$model->hasErrors()) {
                $model->price_in = $stockModel->price_in;
                $model->price_out = $stockModel->price_out;
                $model->save();
                $stockModel->items -= $model->items;
                $stockModel->save();
                return $this->redirect(['view-items', 'id' => $model->id]);
            }
        }

        return $this->render('create-items', ['model' => $model]);
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

        if ($model->load(Yii::$app->request->post())) {
            $stockModel = Stock::findOne(['device_type_id' => $model->device_type_id, 'brand_model_id' => $model->brand_model_id]);
            if ($stockModel) {
                if ($model->discount_applied > 0 && (($model->discount_applied < $stockModel->first_discount * $model->items) || ($model->discount_applied > $stockModel->major_discount * $model->items))) {
                    $model->addError('discount_applied', 'El descuento aplicado debe ser un valor entre ' . $stockModel->first_discount * $model->items . ' y ' . $stockModel->major_discount * $model->items . '.');
                }
            } else {
                $model->addError('type_id', 'No existen dispositivos disponibles con ese tipo/modelo');
            }
            if (!$model->hasErrors()) {
                $model->save();
                return $this->redirect(['view-items', 'id' => $model->id]);
            }
        }
        return $this->render('update-items', ['model' => $model]);
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
        $stockModel = Stock::findOne(['brand_model_id' => $model->brand_model_id, 'device_type_id' => $model->device_type_id]);
        /* if (!$stockModel) {
          $stockModel = new Stock(['brand_model_id' => $model->brand_model_id, 'device_type_id' => $model->device_type_id, 'items' => 0, 'stock_type_id' => $model->deviceType->stock_type_id]);
          } */
        if ($stockModel) {
            $stockModel->items += $model->items;
            $stockModel->save();
        }
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

    public function actionGetBrandModelsForSale() {
        $response = Yii::$app->response;
        $response->format = Response::FORMAT_JSON;
        $post = Yii::$app->request->post();
        $deviceTypeId = $post['depdrop_parents'][0];
        $res = StaticMembers::getBrandModelsByDeviceType($deviceTypeId);
        $response->data = ['output' => $res, 'selected' => []];
        return $response;
    }

    public function actionCalculatePriceWithDiscounts() {
        $response = Yii::$app->response;
        $response->format = Response::FORMAT_JSON;
        $post = Yii::$app->request->post();
        $type = DeviceType::findOne($post['type_id']);
        $model = BrandModel::findOne($post['model_id']);
        $res = [];
        if ($type && $model) {
            $item = Stock::findOne(['device_type_id' => $type->id, 'brand_model_id' => $model->id]);
            $items = $post['items'];
            if ($item && $items && $item->items >= $items) {
                $priceDiff = $item->price_out - $item->price_in;
                $publicPrice = $item->price_out;
                $overallPrice = $item->price_out * $items;
                $firstDiscount = round((0.3 * $priceDiff * $items), 2);
                $majorDiscount = round((0.6 * $priceDiff * $items), 2);
                $priceWithFirstDiscount = $overallPrice - $firstDiscount;
                $priceWithMajorDiscount = $overallPrice - $majorDiscount;
                $discountApplied = isset($post['discount_applied']) ? $post['discount_applied'] : 0;
                $overallPrice -= is_numeric($discountApplied) ? $discountApplied : 0;
                $res = [
                    'publicPrice' => $publicPrice,
                    'overallPrice' => $overallPrice,
                    'firstDiscount' => $firstDiscount,
                    'majorDiscount' => $majorDiscount,
                    'priceWithFirstDiscount' => $priceWithFirstDiscount,
                    'priceWithMajorDiscount' => $priceWithMajorDiscount,
                ];
            } else {
                $res = [
                    'publicPrice' => '0',
                    'overallPrice' => '0',
                    'firstDiscount' => '0.00',
                    'majorDiscount' => '0.00',
                    'priceWithFirstDiscount' => '0.00',
                    'priceWithMajorDiscount' => '0.00',
                ];
            }
        }
        $response->data = $res;
        return $response;
    }

}
