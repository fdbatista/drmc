<?php

use backend\assets\DatePickerAsset;
use backend\assets\PrintAsset;
use common\models\Sale;
use common\utils\AttributesLabels;
use common\utils\StaticMembers;
use yii\bootstrap\ActiveForm;
use yii\web\View;

DatePickerAsset::register($this);
PrintAsset::register($this);

/* @var $this View */
/* @var $model Sale */
/* @var $form ActiveForm */

$this->title = Yii::t('app', 'Imprimir comprobante');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ventas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Detalles de la venta'), 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Imprimir comprobante');
?>

<div class="content">

    <div class="container-fluid" id="print-page">

        <div class="row">
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-12">
                        <p class="img-print">TECNO - CELL</p>
                    </div>
                </div>
            </div>
        </div>

        <div style="font-size: 14px;">
            
            <div class="row data-row">
                <div class="col-sm-6">
                    <span class="data-name">Direcci&oacute;n: </span><span>Av. Ju&aacute;rez 5 Col. Centro, Chilpancingo, Gro.</span>
                </div>
            </div>
            
            <div class="row">
                <div class="col-sm-6">
                    <span class="data-name">Tel&eacute;fono: </span><span>4716037</span>
                </div>
            </div>
            
            <div class="row">
                <div class="col-sm-6">
                    <span class="data-name"><?= AttributesLabels::getAttributeLabel('date') ?>: </span><span><?= $model->date ?></span>
                </div>
            </div>
            
            <div class="row">
                <div class="col-sm-6">
                    <span class="data-name">Folio: </span><span><?= $model->serial_number ?></span>
                </div>
            </div>

            <br />

            <div class="row">
                <div class="col-sm-3">
                    <span class="data-content">PRODUCTO</span>
                </div>
                <div class="col-sm-1">
                    <span class="data-content">CANT</span>
                </div>
                <div class="col-sm-2">
                    <span class="data-content">PRECIO</span>
                </div>
            </div>

            <?php
            $items = $model->saleItems;
            foreach ($items as $key => $value) {
                ?>
                <div class="row">
                    <div class="col-sm-3">
                        <span><?= $value->deviceType->name . ' ' . StaticMembers::getModelAndBrandName($value->brandModel) ?></span>
                    </div>
                    <div class="col-sm-1">
                        <span><?= $value->items ?></span>
                    </div>
                    <div class="col-sm-2">
                        <span>$<?= $value->price_out * $value->items ?></span>
                    </div>
                </div>
                <?php
            }
            ?>

            <div class="row" style="margin-top: 10px;">
                <div class="col-sm-3">
                    <span class="data-name">SUBTOTAL</span>
                </div>
                <div class="col-sm-1"></div>
                <div class="col-sm-2">
                    <span>$<?= $model->total_price + $model->discount_applied ?></span>
                </div>
            </div>
            
            <div class="row">
                <div class="col-sm-3">
                    <span class="data-name">DESCUENTO</span>
                </div>
                <div class="col-sm-1"></div>
                <div class="col-sm-2">
                    <span>$<?= $model->discount_applied ?></span>
                </div>
            </div>
            
            <div class="row">
                <div class="col-sm-3">
                    <span class="data-name">TOTAL</span>
                </div>
                <div class="col-sm-1"></div>
                <div class="col-sm-2">
                    <span class="data-name">$<?= $model->total_price ?></span>
                </div>
            </div>
            
        </div>
    
        <div class="row non-printable">
            <div class="col-sm-12">
                <p class="text-left">
                    <button onclick="print('#print-page')" type="button" class="btn btn-xl btn-success"><i class="material-icons">print</i> Imprimir</button>
                </p>
            </div>
        </div>
    
    </div>

</div>

