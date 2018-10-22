<?php

use common\models\DeviceType;
use common\models\Warehouse;
use common\utils\AttributesLabels;
use common\utils\StaticMembers;
use kartik\widgets\Select2;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $model Warehouse */
/* @var $form ActiveForm */
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
                        <?php $form = ActiveForm::begin(); ?>
                        <?php include_once __DIR__ . '/../layouts/partials/model-errors.php'; ?>
                        <div class="row">
                            <div class="col-sm-6">
                                <?=
                                $form->field($model, 'type_id')->widget(Select2::classname(), [
                                    'data' => ArrayHelper::map(DeviceType::find()->all(), 'id', 'name'),
                                    'language' => 'es',
                                    'options' => ['placeholder' => 'Seleccione un tipo', 'class' => 'form-control'],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                ])->label(false)
                                ?>
                            </div>
                            
                            <div class="col-sm-6">
                                <?=
                                $form->field($model, 'model_id')->widget(Select2::classname(), [
                                    'data' => StaticMembers::getModelsAndBrand(),
                                    'language' => 'es',
                                    'options' => ['placeholder' => 'Seleccione un modelo', 'class' => 'form-control'],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                ])->label(false)
                                ?>
                            </div>
                        </div>

                        <!--<div class="row">
                            <div class="col-sm-12">
                                <?= $form->field($model, 'name', ['inputTemplate' => '<div class="form-group label-floating"><label class="control-label">' . AttributesLabels::getAttributeLabel('name') . '</label>{input}</div>'])->textInput(['maxlength' => true])->label(false) ?>
                            </div>
                        </div>-->
                        
                        <div class="row">
                            <div class="col-sm-3">
                                <?= $form->field($model, 'code', ['inputTemplate' => '<div class="form-group label-floating"><label class="control-label">' . AttributesLabels::getAttributeLabel('code') . '</label>{input}</div>'])->textInput(['maxlength' => true])->label(false) ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($model, 'items', ['inputTemplate' => '<div class="form-group label-floating"><label class="control-label">' . AttributesLabels::getAttributeLabel('items') . '</label>{input}</div>'])->textInput(['maxlength' => true])->label(false) ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($model, 'price_in', ['inputTemplate' => '<div class="form-group label-floating"><label class="control-label">' . AttributesLabels::getAttributeLabel('price_in') . '</label>{input}</div>'])->textInput(['maxlength' => true])->label(false) ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($model, 'price_public', ['inputTemplate' => '<div class="form-group label-floating"><label class="control-label">' . AttributesLabels::getAttributeLabel('price_public') . '</label>{input}</div>'])->textInput(['maxlength' => true])->label(false) ?>
                            </div>
                        </div>

                        <div class="form-group mt-20">
                            <?= Html::submitButton(Yii::t('app', '<i class="material-icons">check</i> Aceptar'), ['class' => 'btn btn-primary pull-right']) ?>
                        </div>
                        <div class="clearfix"></div>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
