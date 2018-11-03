<?php

use backend\assets\DatePickerAsset;
use common\models\Sale;
use common\utils\AttributesLabels;
use common\utils\StaticMembers;
use yii\bootstrap\ActiveForm;
use yii\web\View;

DatePickerAsset::register($this);

/* @var $this View */
/* @var $model Sale */
/* @var $form ActiveForm */

$this->title = Yii::t('app', 'Imprimir comprobante');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Reparaciones'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Datos del dispositivo'), 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Imprimir comprobante');
?>

<div class="content">

    <div class="container-fluid">

        <div class="row non-printable">
            <div class="col-sm-12">
                <p class="text-left">
                    <button onclick="javascript:window.print()" type="button" class="btn btn-xl btn-success"><i class="material-icons">print</i> Imprimir</button>
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-8">
                <div class="row">
                    <div class="col-sm-12">
                        <p id="logo-print">TECNO - CELL</p>
                    </div>
                    <div class="col-sm-12">
                        <p style="text-align: center; font-size: 24px; font-weight: bolder; font-style: italic;">
                            Soporte especializado en:
                        </p>
                        <p style="text-align: center; font-size: 24px; font-weight: bolder; font-style: italic;">
                            Celulares, Tablets y Laptops
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <p>Av. Ju&aacute;rez 5 Col. Centro<br />Chilpancingo, Gro. Tel: 4716037</p>
                    </div>
                    <div class="col-sm-6">
                        <p style="margin-top: 10px;"><span style="font-size: 36px; background: #383838; color: #fff; padding: 2px 3px 0 10px; font-weight: 700;">f</span> Tecno - Cell</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <p style="text-align: left; margin-top: 25px; color: #383838"><i class="material-icons" style="font-size: 120px;">phone_iphone</i></p>
            </div>
        </div>

        <div style="font-size: 16px;">

            <div class="row data-row">
                <div class="col-sm-6">
                    <span class="data-name"><?= AttributesLabels::getAttributeLabel('date') ?>: </span><span class="data-content"><?= $model->date ?></span>
                </div>
            </div>

            <br />

            <div class="row data-row">
                <div class="col-sm-2">
                    <span class="data-name"><?= AttributesLabels::getAttributeLabel('name') ?>: </span>
                </div>
                <div class="col-sm-10">
                    <span class="data-content"><?= $model->customer->name ?></span>
                </div>
            </div>

            <div class="row data-row">
                <div class="col-sm-2">
                    <span class="data-name"><?= AttributesLabels::getAttributeLabel('telephone') ?>: </span>
                </div>
                <div class="col-sm-10">
                    <span class="data-content"><?= $model->customer->telephone ?></span>
                </div>
            </div>

            <div class="row data-row">
                <div class="col-sm-2">
                    <span class="data-name"><?= AttributesLabels::getAttributeLabel('receiver_id') ?>: </span>
                </div>
                <div class="col-sm-10">
                    <span class="data-content"><?= Yii::$app->user->identity->fullName ?></span>
                </div>
            </div>

            <div class="row data-row">
                <div class="col-sm-4">
                    <span class="data-content">Art&iacute;culos</span>
                </div>
                <div class="col-sm-2">
                    <span class="data-content">Cantidad</span>
                </div>
                <div class="col-sm-3">
                    <span class="data-content">Precio</span>
                </div>
            </div>
            
            <br />

            <?php
            $items = $model->saleItems;
            foreach ($items as $key => $value) {
                ?>
                <div class="row">
                    <div class="col-sm-4" style="padding-left: 50px;">
                        <span class="data-name"><?= ($key + 1) . '. ' . $value->deviceType->name . ' ' . StaticMembers::getModelAndBrandName($value->brandModel) ?></span>
                    </div>
                    <div class="col-sm-2">
                        <span class="data-name"><?= $value->items ?></span>
                    </div>
                    <div class="col-sm-3">
                        <span class="data-name">$<?= $value->final_price ?></span>
                    </div>
                </div>
                <?php
            }
            ?>

            <div class="row">
                <div class="col-sm-4" style="padding-left: 50px;">
                    <span class="data-name">TOTAL</span>
                </div>
                <div class="col-sm-2">
                    <span class="data-name"><?= $saleItemsCount ?></span>
                </div>
                <div class="col-sm-3">
                    <span class="data-name">$<?= $saleItemsAmount ?></span>
                </div>
            </div>
            
            <br /><br />

            <div class="row data-row">
                <div class="col-sm-2">
                    <span class="data-name"><?= AttributesLabels::getAttributeLabel('signature_in') ?></span>
                </div>
                <div class="col-sm-2" style="border-bottom: 1px solid grey; margin-top: 15px;"></div>
                <div class="col-sm-2 col-sm-offset-1">
                    <span class="data-name"><?= AttributesLabels::getAttributeLabel('signature_out') ?></span>
                </div>
                <div class="col-sm-2" style="border-bottom: 1px solid grey; margin-top: 15px;"></div>
            </div>

        </div>
    </div>

</div>

