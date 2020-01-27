<?php

namespace backend\controllers;

use common\models\UploadForm;
use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;

class UploadHandlerController extends Controller {

    public function actionUpload($id) {
        $model = new UploadForm();

        if (Yii::$app->request->isPost) {
            $model->media = UploadedFile::getInstancesByName('media');
            return json_encode($model->upload($id));
        }

        return json_encode($model->getUploads($id));
    }

    public function actionDelete($id, $name) {
        if (Yii::$app->request->isPost) {
            $relativeDir = "img/productos";
            $uploadDir = \Yii::$app->getBasePath() . "/../admin/$relativeDir/$id";
            $filePath = "$uploadDir/$name";
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
        $model = new UploadForm();
        return json_encode($model->getUploads($id));
    }

}
