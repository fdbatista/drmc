<?php

use backend\assets\DatePickerAsset;
use common\models\Workshop;
use common\utils\StaticMembers;
use yii\bootstrap\ActiveForm;
use yii\web\View;

DatePickerAsset::register($this);

/* @var $this View */
/* @var $model Workshop */
/* @var $form ActiveForm */

$this->title = Yii::t('app', 'Imprimir comprobante');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Reparaciones'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Datos del dispositivo'), 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Imprimir comprobante');
?>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8">
                <div class="row">
                    <div class="col-sm-12">
                        <p style="background-color: #383838; height: 80px; color: #fff; padding-top: 30px; text-align: center; font-family: Verdana; font-size: 48px; font-weight: 700;">
                            TECNO - CELL
                        </p>
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
        
        <div class="row" style="margin-top: 20px;">
            <div class="col-sm-6">
                Folio: <span style="text-decoration: underline;"><?= $model->folio_number ?></span>
            </div>
            <div class="col-sm-6">
                Fecha: <span style="text-decoration: underline;"><?= $model->date_closed ?></span>
            </div>
        </div>
        
        <div class="row" style="margin-top: 20px;">
            <div class="col-sm-12">
                Nombre: <span style="text-decoration: underline;"><?= $model->customer_name ?></span>
            </div>
        </div>
        
        <div class="row" style="margin-top: 20px;">
            <div class="col-sm-12">
                Tel&eacute;fono: <span style="text-decoration: underline;"><?= $model->customer_telephone ?></span>
            </div>
        </div>
        
        <div class="row" style="margin-top: 20px;">
            <div class="col-sm-12">
                Dispositivo: <span style="text-decoration: underline;"><?= $model->deviceType->name . ' ' . StaticMembers::getModelAndBrandName($model->brandModel) ?></span>
            </div>
        </div>
        
    </div>
</div>
