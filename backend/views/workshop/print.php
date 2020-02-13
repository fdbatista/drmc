<?php

use backend\assets\PrintAsset;
use common\models\Workshop;
use common\utils\AttributesLabels;
use common\utils\StaticMembers;
use yii\bootstrap\ActiveForm;
use yii\web\View;

PrintAsset::register($this);

/* @var $this View */
/* @var $model Workshop */
/* @var $form ActiveForm */

$this->title = Yii::t('app', 'Imprimir comprobante');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Reparaciones'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Datos de la reparación'), 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Imprimir comprobante');

$branch = $model->branch;
?>

<div class="content">

    <div class="container-fluid" id="print-page">

        <div class="row non-printable">
            <div class="col-sm-12">
                <p class="text-left">
                    <button onclick="print('#print-page')" type="button" class="btn btn-xl btn-success"><i class="material-icons">print</i> Imprimir</button>
                </p>
            </div>
        </div>
        
        <div class="row">
            <div class="col-sm-8">
                <div class="row">
                    <div class="col-sm-12">
                        <p class="img-print">TECNO - CELL</p>
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
                        <p><?= $branch->address ?><br />Tel: <?= $branch->phone_number ?></p>
                    </div>
                    <div class="col-sm-6">
                        <p style="margin-top: 10px;"><span class="img-print" style="font-size: 36px; background: #383838; color: #fff; padding: 2px 3px 0 10px; font-weight: 700;">f</span> Tecno - Cell</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <p style="text-align: left; margin-top: 25px; color: #383838"><i class="material-icons" style="font-size: 120px;">phone_iphone</i></p>
            </div>
        </div>

        <div style="font-size: 16px;">

            <div class="row data-row">
                <div class="col-sm-3">
                    <span class="data-name"><?= AttributesLabels::getAttributeLabel('folio_number') ?>: </span>
                </div>
                <div class="col-sm-4">
                    <span class="data-content"><?= $model->folio_number ?></span>
                </div>
                <div class="col-sm-1">
                    <span class="data-name"><?= AttributesLabels::getAttributeLabel('date') ?>: </span>
                </div>
                <div class="col-sm-2">
                    <span class="data-content"><?= $model->date_received ?></span>
                </div>
            </div>

            <br />

            <div class="row data-row">
                <div class="col-sm-3">
                    <span class="data-name"><?= AttributesLabels::getAttributeLabel('name') ?>: </span>
                </div>
                <div class="col-sm-9">
                    <span class="data-content"><?= $model->customer_name ?></span>
                </div>
            </div>

            <div class="row data-row">
                <div class="col-sm-3">
                    <span class="data-name"><?= AttributesLabels::getAttributeLabel('telephone') ?>: </span>
                </div>
                <div class="col-sm-9">
                    <span class="data-content"><?= $model->customer_telephone ?></span>
                </div>
            </div>

            <div class="row data-row">
                <div class="col-sm-3">
                    <span class="data-name"><?= AttributesLabels::getAttributeLabel('device') ?>: </span>
                </div>
                <div class="col-sm-9">
                    <span class="data-content"><?= $model->deviceType->name . ' ' . StaticMembers::getModelAndBrandName($model->brandModel) ?></span>
                </div>
            </div>

            <div class="row data-row">
                <div class="col-sm-3">
                    <span class="data-name"><?= AttributesLabels::getAttributeLabel('pre_diagnosis') ?>: </span>
                </div>
                <div class="col-sm-9">
                    <span class="data-content"><?= $preDiagnosis ?></span>
                </div>
            </div>

            <div class="row data-row">
                <div class="col-sm-3">
                    <span class="data-name"><?= AttributesLabels::getAttributeLabel('receiver_id') ?>: </span>
                </div>
                <div class="col-sm-9">
                    <span class="data-content"><?= $model->receiver->fullName ?></span>
                </div>
            </div>

            <div class="row data-row">
                <div class="col-sm-3">
                    <span class="data-name">Contrase&ntilde;a de la Nube: </span>
                </div>
                <div class="col-sm-9">
                    <span class="data-content"><?= $model->password ? $model->password : $model->pattern ?></span>
                </div>
            </div>

            <div class="row data-row">
                <div class="col-sm-3">
                    <span class="data-name">Costo de la reparaci&oacute;n: </span>
                </div>
                <div class="col-sm-9">
                    <span class="data-content">$<?= $model->final_price ?></span>
                </div>
            </div>

            <?php
            $items = $model->getWorkshopPayments()->orderBy(['date' => 'asc'])->all();
            foreach ($items as $key => $value) {
                ?>
                <div class="row">
                    <div class="col-sm-3" style="padding-left: 30px;">
                        <span class="data-name">Anticipo <?= $key + 1 ?>: </span>
                    </div>
                    <div class="col-sm-1">
                        <span class="data-content">$<?= $value->amount ?></span>
                    </div>
                    <div class="col-sm-1">
                        <span class="data-name">Fecha: </span>
                    </div>
                    <div class="col-sm-3">
                        <span class="data-content"><?= (new DateTime($value->date))->format('Y-m-d') ?></span>
                    </div>
                </div>
                <?php
            }
            ?>

            <div class="row data-row">
                <div class="col-sm-3">
                    <span class="data-name"><?= AttributesLabels::getAttributeLabel('warranty_until') ?>: </span>
                </div>
                <div class="col-sm-4">
                    <span class="data-content"><?= $model->warranty_until ?></span>
                </div>
            </div>
            
            <div class="row data-row">
                <div class="col-sm-3">
                    <span class="data-name"><?= AttributesLabels::getAttributeLabel('observations') ?>: </span>
                </div>
                <div class="col-sm-4">
                    <span class="data-content"><?= $model->observations ?></span>
                </div>
            </div>

            <div class="row signature-row">
                <div class="col-sm-3">
                    <span class="data-name"><?= AttributesLabels::getAttributeLabel('signature_in') ?></span>
                </div>
                <div class="col-sm-2" style="border-bottom: 1px solid grey;"></div>
                <div class="col-sm-3 col-sm-offset-1">
                    <span class="data-name"><?= AttributesLabels::getAttributeLabel('signature_out') ?></span>
                </div>
                <div class="col-sm-2" style="border-bottom: 1px solid grey;"></div>
            </div>

        </div>
    </div>

</div>

