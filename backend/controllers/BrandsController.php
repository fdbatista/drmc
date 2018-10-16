<?php

namespace backend\controllers;

use common\models\Brand;
use common\models\BrandModel;
use common\models\search\BrandModelSearch;
use common\models\search\BrandSearch;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * BrandsController implements the CRUD actions for Modelo.
 */
class BrandsController extends GenericController {

    public function beforeAction($action) {
        $this->entityId = 'brands';
        Yii::$app->view->params['active'] = $this->entityId;
        return parent::beforeAction($action);
    }

    /**
     * Lists all Modelos.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new BrandSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all BrandModel models.
     * @return mixed
     */
    public function actionIndexModels($id) {
        $searchModel = new BrandModelSearch();
        $searchModel->brand_id = $id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index-models', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider]);
    }

    public function actionCreateModels($id) {
        $model = new BrandModel(['brand_id' => $id]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view-models', 'id' => $model->id]);
        }

        return $this->render('create-models', ['model' => $model, 'id' => $id]);
    }

    /**
     * Displays a single BrandModel model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionViewModels($id) {
        return $this->render('view-models', ['model' => $this->findBrandModel($id)]);
    }

    /**
     * Updates an existing BrandModel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdateModels($id) {
        $model = $this->findBrandModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view-models', 'id' => $model->id]);
        }
        return $this->render('update-models', ['model' => $model]);
    }

    /**
     * Deletes an existing BrandModel model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDeleteModels($id) {
        $model = $this->findBrandModel($id);
        $brandId = $model->getBrand()->one()->id;
        $model->delete();
        return $this->actionIndexModels($brandId);
    }

    /**
     * Displays a single Modelo.
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
     * Creates a new Modelo.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Brand();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing Modelo.
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

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Modelo.
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
     * Finds the Modelo based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Brand the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Brand::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    protected function findBrandModel($id) {
        if (($model = BrandModel::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

}
