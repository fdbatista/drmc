<?php

//use kartik\select2\Select2;


use common\models\DeviceType;
use common\models\Shop;
use common\utils\AttributesLabels;
use common\utils\StaticMembers;
use kartik\widgets\Select2;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $model Shop */
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

                        <div class="row">
                            <!--<div class="col-sm-4">
                            <?= $form->field($model, 'inventory', ['inputTemplate' => '<div class="form-group label-floating"><label class="control-label">' . AttributesLabels::getAttributeLabel('inventory') . '</label>{input}</div>'])->textInput(['maxlength' => true])->label(false) ?>
                            </div>-->
                            <div class="col-sm-4">
                                <?= $form->field($model, 'code', ['inputTemplate' => '<div class="form-group label-floating"><label class="control-label">' . AttributesLabels::getAttributeLabel('code') . '</label>{input}</div>'])->textInput(['maxlength' => true])->label(false) ?>
                            </div>
                            <div class="col-sm-4">
                                <?= $form->field($model, 'items', ['inputTemplate' => '<div class="form-group label-floating"><label class="control-label">' . AttributesLabels::getAttributeLabel('items') . '</label>{input}</div>'])->textInput(['maxlength' => true])->label(false) ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                <?= $form->field($model, 'price_in', ['inputTemplate' => '<div class="form-group label-floating"><label class="control-label">' . AttributesLabels::getAttributeLabel('price_in') . '</label>{input}</div>'])->textInput(['maxlength' => true, 'onchange' => 'updateDiscounts()'])->label(false) ?>
                            </div>
                            <div class="col-sm-4">
                                <?= $form->field($model, 'price_out', ['inputTemplate' => '<div class="form-group label-floating"><label class="control-label">' . AttributesLabels::getAttributeLabel('price_out') . '</label>{input}</div>'])->textInput(['maxlength' => true, 'onchange' => 'updateDiscounts()'])->label(false) ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                <?= $form->field($model, 'first_discount', ['inputTemplate' => '<div class="form-group label-floating"><label class="control-label">' . AttributesLabels::getAttributeLabel('first_discount') . '</label>{input}</div>'])->textInput(['maxlength' => true, 'readonly' => true])->label(false) ?>
                            </div>
                            <div class="col-sm-4">
                                <?= $form->field($model, 'major_discount', ['inputTemplate' => '<div class="form-group label-floating"><label class="control-label">' . AttributesLabels::getAttributeLabel('major_discount') . '</label>{input}</div>'])->textInput(['maxlength' => true, 'readonly' => true])->label(false) ?>
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
    <script>
        function updateDiscounts() {
            var price_in = $('#<?= Html::getInputId($model, 'price_in') ?>').val();
            var price_out = $('#<?= Html::getInputId($model, 'price_out') ?>').val();
            $('#<?= Html::getInputId($model, 'first_discount') ?>').val((0.3 * (price_out - price_in)).toFixed(2));
            $('#<?= Html::getInputId($model, 'major_discount') ?>').val((0.6 * (price_out - price_in)).toFixed(2));
        }
    </script>
</div>

