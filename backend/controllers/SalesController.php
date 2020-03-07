<?php

namespace backend\controllers;

use common\models\BrandModel;
use common\models\DeviceType;
use common\models\Sale;
use common\models\SaleItem;
use common\models\search\SaleSearch;
use common\models\Stock;
use Yii;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * SalesController implements the CRUD actions for Sale model.
 */
class SalesController extends GenericController {

    public function beforeAction($action) {
        if (!Yii::$app->user->isGuest && !Yii::$app->session->get('branch_id')) {
            return $this->redirect(['/']);
        }
        $this->entityId = 'sales';
        Yii::$app->view->params['active'] = $this->entityId;
        return parent::beforeAction($action);
    }

    /**
     * Lists all Sale models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new SaleSearch(['branch_id' => Yii::$app->session->get('branch_id')]);
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
        $model = new Sale([
            'branch_id' => Yii::$app->session->get('branch_id'),
            'date' => date('Y-m-d H:i'),
            'discount_applied' => 0,
        ]);
        return $this->render('update-items', ['model' => $model]);
        /* $post = Yii::$app->request->post();
          if (count($post) > 0) {
          if (($post['client-type'] === '1' && $post['Sale']['client-code'] === '') || ($post['client-type'] === '2' && $post['Sale']['customer_id'] === '')) {
          $model->addError('customer_id', 'Debe asociar un cliente a la venta.');
          } else {
          if ($post['Sale']['customer_id'] === '') {
          $customer = Customer::findOne(['code' => $post['Sale']['client-code']]);
          $post['Sale']['customer_id'] = $customer->id;
          }
          if ($model->load($post) && $model->save()) {
          $code = str_pad($model->id, 11, '0', STR_PAD_LEFT);
          $model->serial_number = "V-$code";
          $model->save();
          return $this->actionUpdateItems($model->id);
          }
          }
          }
          $model->date = date('Y-m-d H:i');
          return $this->render('create', ['model' => $model]); */
    }

    /**
     * Updates an existing Sale model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    /* public function actionUpdate($id) {
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
      } */

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
        if (($model = Sale::findOne(['branch_id' => Yii::$app->session->get('branch_id'), 'id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    //--------------------Items-------------------------

    /**
     * Lists all SaleItem models.
     * @return mixed
     */
    /* public function actionIndexItems($id) {
      $searchModel = new SaleItemSearch(['sale_id' => $id]);
      $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

      return $this->render('index-items', [
      'searchModel' => $searchModel,
      'dataProvider' => $dataProvider,
      ]);
      } */

    /**
     * Displays a single SaleItem model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
//    public function actionViewItems($id) {
//        return $this->render('view-items', [
//                    'model' => $this->findItemsModel($id),
//        ]);
//    }

    /**
     * Creates a new SaleItem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    /* public function actionCreateItems($id) {
      $model = new SaleItem(['sale_id' => $id, 'items' => 0, 'price_out' => 0, 'discount_applied' => 0, 'final_price' => 0]);

      if ($model->load(Yii::$app->request->post())) {
      $stockModel = Stock::findOne(['branch_id' => Yii::$app->session->get('branch_id'), 'device_type_id' => $model->device_type_id, 'brand_model_id' => $model->brand_model_id]);
      if ($stockModel) {
      if ($stockModel->items < $model->items) {
      $model->addError('items', 'Solo existen ' . $stockModel->items . ' unidades disponibles de este producto.');
      }
      if ($model->discount_applied > 0 && $model->discount_applied > $stockModel->major_discount * $model->items) {
      $model->addError('discount_applied', 'El descuento aplicado no debe ser mayor de ' . $stockModel->major_discount * $model->items . '.');
      }
      } else {
      $model->addError('type_id', 'No existen dispositivos disponibles con ese tipo/modelo');
      }
      if (!$model->hasErrors()) {
      $model->price_in = $stockModel->price_in;
      $model->price_out = $stockModel->price_out;
      $model->final_price = ($stockModel->price_out * $model->items) - $model->discount_applied;
      if ($model->save()) {
      $stockModel->items -= $model->items;
      $stockModel->save();
      return $this->redirect(['view-items', 'id' => $model->id]);
      }
      }
      }

      return $this->render('create-items', ['model' => $model]);
      } */

    public function actionGetAvailableItemsForSale($saleId) {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $result = ['stock' => [], 'cart' => [], 'discount_applied' => $saleId ? Sale::findOne($saleId)->discount_applied : 0];

        $stockItems = Stock::find()->where(['branch_id' => Yii::$app->session->get('branch_id')/*, 'stock_type_id' => 1*/])->andWhere('items > 0')->select(['code', 'items', 'price_in', 'price_out', 'first_discount', 'major_discount', 'device_type_id', 'brand_model_id', 'stock_type_id'])->asArray()->all();
        foreach ($stockItems as $item) {
            $result['stock'][] = $this->addAvailableItemData($item, 'stock');
        }

        $saleItems = SaleItem::find()->where(['sale_id' => $saleId])->asArray()->all();
        foreach ($saleItems as $saleItem) {
            $result['cart'][] = $this->addAvailableItemData($saleItem, 'cart');
        }

        return $result;
    }

    private function addAvailableItemData($item, $type) {
        $newItem = $item;
        $newItem['device_type'] = DeviceType::findOne($item['device_type_id'])->name;
        $brandModel = BrandModel::findOne($item['brand_model_id']);
        $newItem['brand_model'] = "{$brandModel->brand->name} {$brandModel->name}";
        if ($type === 'cart') {
            $newItem['quantity'] = $newItem['items'];
            $newItem['price'] = $newItem['items'] * $newItem['price_out'];
        }
        return $newItem;
    }

    public function actionUpdateItems($id) {
        $model = $this->findModel($id);

        /* if ($model->load(Yii::$app->request->post())) {
          $stockModel = Stock::findOne(['branch_id' => Yii::$app->session->get('branch_id'), 'device_type_id' => $model->device_type_id, 'brand_model_id' => $model->brand_model_id]);
          if ($stockModel) {
          if ($model->discount_applied > 0 && $model->discount_applied > $stockModel->major_discount * $model->items) {
          $model->addError('discount_applied', 'El descuento aplicado no debe ser mayor de ' . $stockModel->major_discount * $model->items . '.');
          }
          } else {
          $model->addError('type_id', 'No existen dispositivos disponibles con ese tipo/modelo');
          }
          if (!$model->hasErrors()) {
          $model->final_price = ($stockModel->price_out * $model->items) - $model->discount_applied;
          $model->save();
          return $this->redirect(['view-items', 'id' => $model->id]);
          }
          } */
        return $this->render('update-items', ['model' => $model]);
    }

    /**
     * Deletes an existing SaleItem model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    /* public function actionDeleteItems($id) {
      $model = $this->findItemsModel($id);
      $stockModel = Stock::findOne(['branch_id' => Yii::$app->session->get('branch_id'), 'brand_model_id' => $model->brand_model_id, 'device_type_id' => $model->device_type_id]);

      if ($stockModel) {
      $stockModel->items += $model->items;
      $stockModel->save();
      }
      $parent_id = $model->sale_id;
      $model->delete();
      return $this->actionIndexItems($parent_id);
      } */

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

    /* public function actionGetBrandModelsForSale() {
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
      $item = Stock::findOne(['branch_id' => Yii::$app->session->get('branch_id'), 'device_type_id' => $type->id, 'brand_model_id' => $model->id]);
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
      } */

    public function actionPrint($id) {
        $model = $this->findModel($id);
        $saleItems = $model->saleItems;

        $transaction = Yii::$app->db->beginTransaction();

        foreach ($saleItems as $saleItem) {
            $differenceErrors = [];

            if ($model->status !== 1) {
                $stockModel = Stock::findOne(['branch_id' => $model->branch_id, 'device_type_id' => $saleItem->device_type_id, 'brand_model_id' => $saleItem->brand_model_id]);
                $difference = $stockModel->items - $saleItem->items;
                if ($difference >= 0) {
                    $stockModel->items = $difference;
                    $stockModel->save();
                } else {
                    $differenceErrors['id'][] = "Solo quedan {$stockModel->items} unidades de {$stockModel->deviceType->name} {$stockModel->brandModel->name}";
                }
            }
        }

        if (count($differenceErrors) > 0) {
            $transaction->rollBack();
            $model->addErrors($differenceErrors);
            return $this->actionUpdateItems($id);
        }
        $model->status = 1;
        $model->save();
        $transaction->commit();

        return $this->render('print', ['model' => $model]);
    }

    public function actionAjaxSetItems() {
        $response = Yii::$app->response;
        $response->format = Response::FORMAT_JSON;
        $post = Yii::$app->request->post();

        $saleId = $post['sale_id'];
        
        if ($saleId) {
            $sale = $this->findModel($saleId);
        } else {
            $sale = new Sale([
                'branch_id' => Yii::$app->session->get('branch_id'),
                'date' => date('Y-m-d H:i'),
            ]);
            $sale->save();
        }
        
        $transaction = Yii::$app->db->beginTransaction();
        SaleItem::deleteAll(['sale_id' => $sale->id]);

        try {
            $devices = $post['devices'];
            $discountApplied = $post['discount_applied'];
            $maxDiscountsSum = 0;
            $totalSalePrice = 0;

            foreach ($devices as $device) {
                $stockModel = Stock::findOne(['branch_id' => Yii::$app->session->get('branch_id'), 'device_type_id' => $device['device_type_id'], 'brand_model_id' => $device['brand_model_id']]);

                if (!$stockModel) {
                    throw new Exception("No existen dispositivos disponibles de tipo {$device['device_type']} y marca {$device['brand_model']}.");
                }

                $itemsCount = $device['items'];

                if ($itemsCount > $stockModel->items) {
                    throw new Exception("La cantidad de unidades de tipo {$device['device_type']} y marca {$device['brand_model']} no puede ser mayor que {$stockModel->items}.");
                }

                //$itemFinalPrice = ($stockModel->price_out * $itemsQuantity) - $discountApplied;

                $saleItem = new SaleItem([
                    'price_in' => $stockModel->price_in,
                    'price_out' => $stockModel->price_out,
                    'items' => $itemsCount,
                    //'discount_applied' => $discountApplied,
                    //'final_price' => $itemFinalPrice,
                    'device_type_id' => $stockModel->device_type_id,
                    'brand_model_id' => $stockModel->brand_model_id,
                    'sale_id' => $sale->id,
                ]);

                $saleItem->save();
                $maxItemDiscount = $stockModel->major_discount * $itemsCount;
                $maxDiscountsSum += $maxItemDiscount;
                $totalSalePrice += ($stockModel->price_out * $itemsCount);
            }

            if ($discountApplied > 0 && $discountApplied > $maxDiscountsSum) {
                $transaction->rollBack();
                throw new Exception("El descuento aplicado no debe ser mayor de $maxDiscountsSum.");
            }

            $sale->discount_applied = $discountApplied;
            $sale->total_price = $totalSalePrice - $discountApplied;
            $code = str_pad($sale->id, 11, '0', STR_PAD_LEFT); 
            $sale->serial_number = "V-$code"; 
            $sale->save();
            $transaction->commit();

            $response->data = ['msg' => "Operación realizada con éxito.", 'data' => $sale->id];
            return $response;
        } catch (Exception $exc) {
            $transaction->rollBack();
            throw $exc;
        }
    }

}
