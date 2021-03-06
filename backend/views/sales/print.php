<?php

use backend\assets\DatePickerAsset;
use backend\assets\PrintAsset;
use common\models\AppConfig;
use common\models\Sale;
use common\utils\AttributesLabels;
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

$branch = $model->branch;
$appConfig = AppConfig::findOne(1);
?>

<div class="content">

    <div class="container-fluid" id="print-page">

        <div class="row">
            <div class="col-sm-3">
                <div class="row">
                    <div class="col-sm-12">
                        <p class="img-print text-uppercase"><?= $appConfig->app_title ?></p>
                    </div>
                </div>
            </div>
        </div>

        <div style="font-size: 14px;">

            <div class="row data-row">
                <div class="col-sm-3">
                    <span class="data-name">Direcci&oacute;n: </span><span><?= $branch->address ?></span>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-3">
                    <span class="data-name">Tel&eacute;fono: </span><span><?= $branch->phone_number ?></span>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-3">
                    <span class="data-name"><?= AttributesLabels::getAttributeLabel('date') ?>: </span><span><?= $model->date ?></span>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-3">
                    <span class="data-name">Folio: </span><span><?= $model->serial_number ?></span>
                </div>
            </div>

            <br />

            <div class="row">
                <div class="col-sm-1">
                    <span class="data-content">PRODUCTO</span>
                </div>
                <div class="col-sm-1">
                    <span class="data-content pull-right">CANT</span>
                </div>
                <div class="col-sm-1">
                    <span class="data-content pull-right">PRECIO</span>
                </div>
            </div>

            <?php
            $items = $model->saleItems;
            foreach ($items as $key => $value) {
                ?>
                <div class="row">
                    <div class="col-sm-1">
                        <span><?= $value->deviceType->name ?></span>
                    </div>
                    <div class="col-sm-1">
                        <span class="pull-right"><?= $value->items ?></span>
                    </div>
                    <div class="col-sm-1">
                        <span class="pull-right">$<?= $value->price_out * $value->items ?></span>
                    </div>
                </div>
                <?php
            }
            ?>

            <div class="row" style="margin-top: 10px;">
                <div class="col-sm-1">
                    <span class="data-name">SUBTOTAL</span>
                </div>
                <div class="col-sm-1"></div>
                <div class="col-sm-1">
                    <span class="pull-right">$<?= $model->total_price + $model->discount_applied ?></span>
                </div>
            </div>

            <?php
            if ($model->discount_applied > 0) {
                ?>
                <div class="row">
                    <div class="col-sm-1">
                        <span class="data-name">DESCUENTO</span>
                    </div>
                    <div class="col-sm-1"></div>
                    <div class="col-sm-1">
                        <span class="pull-right">$<?= $model->discount_applied ?></span>
                    </div>
                </div>
                <?php
            }
            ?>

            <div class="row">
                <div class="col-sm-1">
                    <span class="data-name">TOTAL</span>
                </div>
                <div class="col-sm-1"></div>
                <div class="col-sm-1">
                    <span class="data-name data-content pull-right">$<?= $model->total_price ?></span>
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

