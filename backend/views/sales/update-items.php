<?php

use common\models\Sale;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $model Sale */
/* @var $form ActiveForm */

$this->title = 'Dispositivos';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ventas'), 'url' => ['index']];

if ($model->id) {
    $this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Detalles de la venta'), 'url' => ['view', 'id' => $model->id]];
}

$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile('@web/js/sales-items-helper.js', ['depends' => 'yii\web\JqueryAsset']);

?>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header" data-background-color="purple">
                        <h4 class="title"><?= $this->title ?></h4>
                        <p class="category">Complete el siguiente formulario</p>
                    </div>
                    <div class="card-content">
                        
                        <?php include_once __DIR__ . '/../layouts/partials/model-errors.php'; ?>
                        
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">C&oacute;digo</label>
                                    <input id="new-item-code" class="form-control" autofocus />
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group label-floating">
                                    <button id="btn-add-item" class="btn btn-primary btn-sm">+</button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <?= Html::hiddenInput('sale_id', $model->id, ['id' => 'sale_id']) ?>
                            <div class="col-sm-3">
                                <span class="text-uppercase underline">Producto</span>
                            </div>
                            <div class="col-sm-3">
                                <span class="text-uppercase underline">Modelo</span>
                            </div>
                            <div class="col-sm-2">
                                <span class="text-uppercase underline">Precio</span>
                            </div>
                            <div class="col-sm-3">
                                <span class="text-uppercase underline">Cantidad</span>
                            </div>
                        </div>
                        <div id="cart-items">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
