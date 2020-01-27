<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\helpers\Url;
use yii\web\UploadedFile;

class UploadForm extends Model {

    /**
     * @var UploadedFile[]
     */
    public $media;

    public function rules() {
        return [
            [['media'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'maxFiles' => 100],
        ];
    }

    public function upload($id) {

        $result = ['files' => []];

        if ($this->validate()) {
            foreach ($this->media as $file) {
                $fileName = preg_replace('/[^a-zA-Z0-9]+/', '_', strtolower(str_replace(".$file->extension", "", $file->name))) . ".$file->extension";
                $relativeDir = "img/productos";
                $uploadDir = \Yii::$app->getBasePath() . "/../admin/$relativeDir/$id/";

                if (!file_exists($uploadDir)) {
                    mkdir($uploadDir);
                }

                $fileAbsolutePath = "$uploadDir/$fileName";

                if ($file->saveAs($fileAbsolutePath)) {
                    $url = Url::base(true) . "/$relativeDir/$id/$fileName";
                    $result['files'][] = [
                        'name' => $fileName,
                        'size' => $file->size,
                        'url' => $url,
                        'thumbnailUrl' => $url,
                        'deleteUrl' => "/upload-handler/delete?id=$id&name=$fileName",
                        'deleteType' => 'POST',
                    ];
                }
            }
        }
        return $result;
    }

    public function getUploads($id) {
        $result = ['files' => []];
        $absolutePath = \Yii::$app->getBasePath() . "/../admin/img/productos/$id";
        $files = array_diff(scandir($absolutePath), array('.', '..'));

        foreach ($files as $file) {
            $url = Url::base(true) . "/img/productos/$id/$file";
            $result['files'][] = [
                'name' => $file,
                'size' => filesize("$absolutePath/$file"),
                'url' => $url,
                'thumbnailUrl' => $url,
                'deleteUrl' => "/upload-handler/delete?id=$id&name=$file",
                'deleteType' => 'POST',
            ];
        }
        return $result;
    }

}
