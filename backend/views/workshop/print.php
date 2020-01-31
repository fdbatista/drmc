<?php

use backend\assets\DatePickerAsset;
use backend\assets\PrintAsset;
use common\models\AppConfig;
use common\models\Workshop;
use common\utils\AttributesLabels;
use common\utils\StaticMembers;
use yii\bootstrap\ActiveForm;
use yii\web\View;

DatePickerAsset::register($this);
PrintAsset::register($this);

/* @var $this View */
/* @var $model Workshop */
/* @var $form ActiveForm */

$this->title = Yii::t('app', 'Imprimir comprobante');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Reparaciones'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Datos de la reparación'), 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Imprimir comprobante');

$branch = $model->branch;
$appConfig = AppConfig::findOne(1);
?>

<div class="content">

    <div class="container-fluid" id="print-page">

        <div class="row">
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-12">
                        <p class="img-print text-uppercase"><?= $appConfig->app_title ?></p>
                    </div>
                </div>
            </div>
        </div>

        <div style="font-size: 14px;">

            <div class="row data-row">
                <div class="col-sm-6">
                    <span class="data-name">Direcci&oacute;n: </span><span><?= $branch->address ?></span>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <span class="data-name">Tel&eacute;fono: </span><span><?= $branch->phone_number ?></span>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <span class="data-name"><?= AttributesLabels::getAttributeLabel('folio_number') ?>: </span><span><?= $model->folio_number ?></span>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <span class="data-name"><?= AttributesLabels::getAttributeLabel('date_received') ?>: </span><span><?= $model->date_received ?></span>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <span class="data-name"><?= AttributesLabels::getAttributeLabel('date_closed') ?>: </span><span><?= $model->date_closed ?></span>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <span class="data-name"><?= AttributesLabels::getAttributeLabel('name') ?>: </span><span><?= $model->customer_name ?></span>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <span class="data-name"><?= AttributesLabels::getAttributeLabel('telephone') ?>: </span><span><?= $model->customer_telephone ?></span>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <span class="data-name"><?= AttributesLabels::getAttributeLabel('device') ?>: </span><span><?= $model->deviceType->name . ' ' . StaticMembers::getModelAndBrandName($model->brandModel) ?></span>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <span class="data-name"><?= AttributesLabels::getAttributeLabel('pre_diagnosis') ?>: </span><span><?= $preDiagnosis ?></span>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <span class="data-name"><?= AttributesLabels::getAttributeLabel('receiver_id') ?>: </span><span><?= $model->receiver->fullName ?></span>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <span class="data-name">Contrase&ntilde;a de la nube: </span><span><?= $model->password ? $model->password : $model->pattern ?></span>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <span class="data-name">Costo de la reparaci&oacute;n: </span><span>$<?= $model->final_price ?></span>
                </div>
            </div>

            <br />


            <?php
            $items = $model->getWorkshopPayments()->orderBy(['date' => 'asc'])->all();
            if (count($items) > 0) {
                ?>
                <div class="row">
                    <div class="col-sm-3">
                        <span class="data-content">ANTICIPO</span>
                    </div>
                    <div class="col-sm-1">
                        <span class="data-content">FECHA</span>
                    </div>
                    <div class="col-sm-1">
                        <span class="data-content">CANT</span>
                    </div>
                </div>
                <?php
            }
            foreach ($items as $key => $value) {
                ?>
                <div class="row">
                    <div class="col-sm-3">
                        <span class="data-name">Anticipo <?= $key + 1 ?>: </span>
                    </div>
                    <div class="col-sm-1">
                        <span class="data-content"><?= (new DateTime($value->date))->format('Y-m-d') ?></span>
                    </div>
                    <div class="col-sm-1">
                        <span class="data-content">$<?= $value->amount ?></span>
                    </div>
                </div>
                <?php
            }
            ?>

            <div class="row">
                <div class="col-sm-6">
                    <span class="data-name"><?= AttributesLabels::getAttributeLabel('warranty_until') ?>: </span><span><?= $model->warranty_until ?></span>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <span class="data-name"><?= AttributesLabels::getAttributeLabel('observations') ?>: </span><span><?= $model->observations ?></span>
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

