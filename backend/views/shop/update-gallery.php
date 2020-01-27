<?php

//use kartik\select2\Select2;


use common\models\DeviceType;
use common\models\Stock;
use common\utils\AttributesLabels;
use common\utils\StaticMembers;
use kartik\widgets\Select2;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View;

use dosamigos\fileupload\FileUploadUI;

/* @var $this View */
/* @var $model Stock */
/* @var $form ActiveForm */

$this->title = Yii::t('app', 'Actualizar dispositivo');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tienda'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Detalles del dispositivo'), 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Galería');
?>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header" data-background-color="purple">
                        <h4 class="title"><?= $this->title ?></h4>
                        <p class="category">Actualizar galer&iacute;a</p>
                    </div>
                    <div class="card-content">
                        <div class="row">
                            <div class="col-sm-12">
                                <?= FileUploadUI::widget([
                                        'name' => 'media',
                                        'url' => ['upload-handler/upload', 'id' => $model->id],
                                        'gallery' => false,
                                        'load' => true,
                                        'fieldOptions' => [
                                                'accept' => 'image/*'
                                        ],
                                        'clientOptions' => [
                                                'maxFileSize' => 2000000
                                        ],
                                        // ...
                                        'clientEvents' => [
                                            'fileuploaddone' => 'function(e, data) {
                                                                    console.log(e);
                                                                    console.log(data);
                                                                }',
                                            'fileuploadfail' => 'function(e, data) {
                                                                    console.log(e);
                                                                    console.log(data);
                                                                }',
                                    ],
                                ]);
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

