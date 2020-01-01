<?php

namespace backend\controllers;

use common\models\search\WorkshopPaymentSearch;
use common\models\search\WorkshopSearch;
use common\models\Stock;
use common\models\Workshop;
use common\models\WorkshopPayment;
use common\models\WorkshopPreDiagnosis;
use common\utils\StaticMembers;
use Yii;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * WorkshopController implements the CRUD actions for Workshop model.
 */
class WorkshopController extends GenericController {

    public function beforeAction($action) {
        if (!Yii::$app->user->isGuest && !Yii::$app->session->get('branch_id')) {
            return $this->redirect(['/']);
        }
        $this->entityId = 'workshop';
        Yii::$app->view->params['active'] = $this->entityId;
        return parent::beforeAction($action);
    }

    /**
     * Lists all Workshop models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new WorkshopSearch(['branch_id' => Yii::$app->session->get('branch_id')]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
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

    private function updateFolioNumber(Workshop $model) {
        $newId = Yii::$app->db->createCommand('select coalesce(max(`id`), 0) + 1 as `count` from `workshop`')->queryScalar();
        $model->folio_number = str_pad($newId, 11, '0', STR_PAD_LEFT);
    }

    /**
     * Creates a new Workshop model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Workshop(['branch_id' => Yii::$app->session->get('branch_id'), 'date_received' => date('Y-m-d'), 'receiver_id' => Yii::$app->user->identity->id, 'final_price' => 0]);
        $this->updateFolioNumber($model);

        if ($model->load(Yii::$app->request->post())) {
            if ($model->hasErrors()) {
                return $this->render('create', ['model' => $model, 'passwordOrPattern' => $model->password ? 1 : 2]);
            }
            $model->save();
            $preDiagnosisItems = json_decode(Yii::$app->request->post()['pre-diagnosis-items'], true);
            foreach ($preDiagnosisItems as $preDiagnosisItem) {
                $stockModel = Stock::findOne(['branch_id' => Yii::$app->session->get('branch_id'), 'stock_type_id' => 2, 'device_type_id' => $preDiagnosisItem['id'], 'brand_model_id' => $model->brand_model_id]);
                if ($stockModel) {
                    if ($preDiagnosisItem['items'] <= $stockModel->items) {
                        $workshopPreDiagnosis = new WorkshopPreDiagnosis();
                        $workshopPreDiagnosis->items = $preDiagnosisItem['items'];
                        $workshopPreDiagnosis->workshop_id = $model->id;
                        $workshopPreDiagnosis->device_type_id = $stockModel->device_type_id;
                        $workshopPreDiagnosis->price_in = $stockModel->price_in;
                        $workshopPreDiagnosis->price_out = $stockModel->price_out;
                        $workshopPreDiagnosis->save();
                        $stockModel->items -= $preDiagnosisItem['items'];
                        if ($stockModel->items > 0) {
                            $stockModel->save();
                        } else {
                            $stockModel->delete();
                        }
                    }
                }
            }
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
        $model->branch_id = Yii::$app->session->get('branch_id');
        $model->final_price = 0;
        if ($model->status === 1) {
            return $this->actionView($id);
        }

        if ($model->load(Yii::$app->request->post())) {
            $this->validateDiscountApplied($model);
            if ($model->hasErrors()) {
                return $this->actionView($id);
            }
            $model->save();
            $this->restoreStockItemsInPreDiagnosis($model);

            $preDiagnosisItems = json_decode(Yii::$app->request->post()['pre-diagnosis-items'], true);
            if ($preDiagnosisItems) {
                foreach ($preDiagnosisItems as $preDiagnosisItem) {
                    $stockModel = Stock::findOne(['branch_id' => Yii::$app->session->get('branch_id'), 'stock_type_id' => 2, 'device_type_id' => $preDiagnosisItem['id'], 'brand_model_id' => $model->brand_model_id]);
                    if ($stockModel) {
                        if ($preDiagnosisItem['items'] <= $stockModel->items) {
                            $workshopPreDiagnosis = new WorkshopPreDiagnosis();
                            $workshopPreDiagnosis->items = $preDiagnosisItem['items'];
                            $workshopPreDiagnosis->workshop_id = $model->id;
                            $workshopPreDiagnosis->device_type_id = $stockModel->device_type_id;
                            $workshopPreDiagnosis->price_in = $stockModel->price_in;
                            $workshopPreDiagnosis->price_out = $stockModel->price_out;
                            $workshopPreDiagnosis->save();
                            $stockModel->items -= $preDiagnosisItem['items'];
                            if ($stockModel->items > 0) {
                                $stockModel->save();
                            } else {
                                $stockModel->delete();
                            }
                        }
                    }
                }
            }
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
        $model = $this->findModel($id);
        if ($model->status === 0) {
            $this->restoreStockItemsInPreDiagnosis($model);
        }
        $model->delete();
        return $this->redirect(['index']);
    }

    private function restoreStockItemsInPreDiagnosis(Workshop $model) {
        $currentPreDiagnosisItems = $model->workshopPreDiagnoses;
        foreach ($currentPreDiagnosisItems as $currentPreDiagnosisItem) {
            $stockModel = Stock::findOne(['branch_id' => Yii::$app->session->get('branch_id'), 'stock_type_id' => 2, 'device_type_id' => $currentPreDiagnosisItem->device_type_id, 'brand_model_id' => $model->brand_model_id]);
            if (!$stockModel) {
                $stockModel = new Stock(['branch_id' => Yii::$app->session->get('branch_id'), 'stock_type_id' => 2, 'device_type_id' => $currentPreDiagnosisItem->device_type_id, 'brand_model_id' => $model->brand_model_id, 'items' => $currentPreDiagnosisItem->items]);
            } else {
                $stockModel->items += $currentPreDiagnosisItem->items;
            }
            $stockModel->save();
            $currentPreDiagnosisItem->delete();
        }
    }

    /**
     * Finds the Workshop model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Workshop the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Workshop::findOne(['branch_id' => Yii::$app->session->get('branch_id'), 'id' => $id])) !== null) {
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
        $searchModel = $this->findModel($id);
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
        $model = $this->findPaymentModel($id);
        return $this->render('view-payments', [
                    'model' => $model, 'parent' => $model->workshop
        ]);
    }

    /**
     * Creates a new WorkshopPayment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreatePayments($id) {
        $parent = $this->findModel($id);
        $model = new WorkshopPayment();
        $model->workshop_id = $id;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->actionIndexPayments($id);
        }
        $model->date = date('Y-m-d H:i');
        return $this->render('create-payments', ['model' => $model, 'parent' => $parent]);
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
                    'model' => $model, 'parent' => $model->workshop
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
        $model = WorkshopPayment::findOne([$id]);
        if (!$model) {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }
        $parent = $model->workshop;
        if ($parent->branch_id == Yii::$app->session->get('branch_id')) {
            return $model;
        }
        throw new NotFoundHttpException(Yii::t('app', 'This item does not belong to the current branch.'));
    }

    public function actionGetPreDiagnosisItems() {
        $response = Yii::$app->response;
        $response->format = Response::FORMAT_JSON;
        $params = Yii::$app->request->get();
        $modelId = $params['model_id'];
        $preDiagnosis = [];
        //$warehouseDevices = [];
        $model = Workshop::findOne($modelId);
        if ($model) {
            $array = $model->workshopPreDiagnoses;
            foreach ($array as $preDiagnose) {
                $stockModel = Stock::findOne(['branch_id' => Yii::$app->session->get('branch_id'), 'stock_type_id' => 2, 'device_type_id' => $preDiagnose->device_type_id, 'brand_model_id' => $model->brand_model_id]);
                $preDiagnosis[] = ['id' => $preDiagnose->deviceType->id, 'name' => $preDiagnose->deviceType->name, 'items' => $preDiagnose->items, 'major_discount' => $stockModel->major_discount, 'price_out' => $stockModel->price_out];
            }
            //$warehouseDevices = StaticMembers::getWarehouseItemsByBrandModel($model->brand_model_id);
        }
        //$response->data = ['pre_diagnosis' => $preDiagnosis, 'warehouse_devices' => $warehouseDevices];
        $response->data = $preDiagnosis;
        return $response;
    }

    public function actionGetWarehouseItemsByBrandModel() {
        $response = Yii::$app->response;
        $response->format = Response::FORMAT_JSON;
        $post = Yii::$app->request->post();
        $brandModelId = $post['depdrop_parents'][0];
        $res = StaticMembers::getWarehouseItemsByBrandModel($brandModelId);
        $response->data = ['output' => $res, 'selected' => []];
        return $response;
    }

    public function actionPrint($id) {
        $model = $this->findModel($id);
        $preDiagnoses = $model->workshopPreDiagnoses;
        $preDiagnosisStr = '';
        foreach ($preDiagnoses as $preDiagnose) {
            $preDiagnosisStr .= ($preDiagnose->deviceType->name . ' (' . $preDiagnose->items . '), ');
        }
        return $this->render('print', [
                    'model' => $model,
                    'preDiagnosis' => trim($preDiagnosisStr, ", ")
        ]);
    }

    private function validateDiscountApplied(Workshop $model) {
        $minDiscount = 0;
        $maxDiscount = 0;
        $preDiagnosisItems = $model->workshopPreDiagnoses;
        foreach ($preDiagnosisItems as $preDiagnosisItem) {
            $stockModel = Stock::findOne(['branch_id' => Yii::$app->session->get('branch_id'), 'device_type_id' => $preDiagnosisItem->device_type_id, 'brand_model_id' => $model->brand_model_id]);
            if ($stockModel) {
                $minDiscount += ($stockModel->first_discount * $preDiagnosisItem->items);
                $maxDiscount += ($stockModel->major_discount * $preDiagnosisItem->items);
            }
        }

        if ($model->discount_applied !== '0' && $model->discount_applied > $maxDiscount) {
            $model->addError('discount_applied', "El descuento aplicado no debe ser mayor de $maxDiscount.");
            $model->final_price += $model->discount_applied;
        }
    }

    public function actionFinishRepair($id) {
        $model = $this->findModel($id);
        $model->date_closed = date('Y-m-d');

        if ($model->load(Yii::$app->request->post())) {
            if (!$model->warranty_until) {
                $model->addError('warranty_until', 'Este dato es obligatorio');
            }

            if (!$model->hasErrors()) {
                $model->status = 1;
                $model->save();
                return $this->redirect(['print', 'id' => $model->id]);
            }
        }
        return $this->render('finish-repair', ['model' => $model, 'passwordOrPattern' => $model->password ? 1 : 2]);
    }

}
