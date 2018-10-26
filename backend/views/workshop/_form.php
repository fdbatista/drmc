<?php

use backend\assets\DatePickerAsset;
use backend\assets\PatternLockAsset;
use common\models\DeviceType;
use common\models\Workshop;
use common\utils\AttributesLabels;
use common\utils\StaticMembers;
use kartik\widgets\Select2;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View;

PatternLockAsset::register($this);
DatePickerAsset::register($this);


/* @var $this View */
/* @var $model Workshop */
/* @var $form ActiveForm */

$this->registerJs("setLockPattern('" . $model->pattern . "')");
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
                                $form->field($model, 'device_type_id')->widget(Select2::classname(), [
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
                                $form->field($model, 'brand_model_id')->widget(Select2::classname(), [
                                    'data' => StaticMembers::getModelsAndBrand(),
                                    'language' => 'es',
                                    'options' => ['placeholder' => 'Seleccione un modelo', 'class' => 'form-control', 'id' => 'brand_model_id'],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                    'pluginEvents' => [
                                        "select2:change" => 'function(){ $("#curr_brand_model_id").val($(this).val()); }',
                                    ]
                                ])->label(false)
                                ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <?= Html::hiddenInput('workshop_id', $model->id, ['id' => 'workshop-id']) ?>
                                    <?= Html::hiddenInput('base_url', Yii::$app->getHomeUrl(), ['id' => 'base-url']) ?>
                                    <?= Html::hiddenInput('new-pre-diagnosis-item', null, ['id' => 'new-pre-diagnosis-item']) ?>
                                    <?= Html::hiddenInput('pre-diagnosis-items', null, ['id' => 'pre-diagnosis-items']) ?>
                                    <label>Pre diagn&oacute;stico</label><br />
                                    <button onclick="showPreDiagnosisItemDlg()" type="button" class="btn btn-xs btn-info">Agregar</button>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-sm-4"><span class="table-header">Tipo</span></div>
                                                <div class="col-sm-3"><span class="table-header">Cantidad</span></div>
                                                <div class="col-sm-4"><span class="table-header">Acciones</span></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12" id="pre-diagnosis-items-container" style="padding-left: 20px;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                <?= $form->field($model, 'serial_number', ['inputTemplate' => '<div class="form-group label-floating"><label class="control-label">' . AttributesLabels::getAttributeLabel('serial_number') . '</label>{input}</div>'])->textInput(['maxlength' => true])->label(false) ?>
                            </div>
                            <div class="col-sm-4">
                                <?= $form->field($model, 'effort', ['inputTemplate' => '<div class="form-group label-floating"><label class="control-label">' . AttributesLabels::getAttributeLabel('effort') . '</label>{input}</div>'])->textInput(['maxlength' => true])->label(false) ?>
                            </div>
                            <div class="col-md-4">
                                <?= $form->field($model, 'date_received', ['inputTemplate' => '<div class="form-group label-floating"><label class="control-label">' . AttributesLabels::getAttributeLabel('date_received') . '</label>{input}</div>'])->textInput(['maxlength' => true, 'class' => 'datetimepicker form-control', 'readonly' => 'readonly'])->label(false) ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <?= $form->field($model, 'observations', ['inputTemplate' => '<div class="form-group label-floating"><label class="control-label">' . AttributesLabels::getAttributeLabel('observations') . '</label>{input}</div>'])->textarea(['maxlength' => true, 'class' => 'form-control'])->label(false) ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <?=
                                    Select2::widget([
                                        'id' => 'passwordOrPattern',
                                        'name' => 'passwordOrPattern',
                                        'data' => [1 => 'Contraseña', 2 => 'Patrón'],
                                        'value' => $passwordOrPattern,
                                        'pluginEvents' => [
                                            "select2:select" => 'function() {if ($(this).val() === "1") {$("#password-container").removeClass("hidden");$("#pattern-container").addClass("hidden");} else {$("#pattern-container").removeClass("hidden");$("#password-container").addClass("hidden");}}',
                                        ]
                                    ])
                                    ?>
                                </div>
                            </div>
                        </div>

                        <div id="password-container" class="row animated fadeIn <?= $passwordOrPattern === 1 ? '' : 'hidden' ?>">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <?= $form->field($model, 'password', ['inputTemplate' => '<div class="form-group label-floating"><label class="control-label">' . AttributesLabels::getAttributeLabel('password') . '</label>{input}</div>'])->textInput(['maxlength' => true])->label(false) ?>
                                </div>
                            </div>
                        </div>

                        <div id="pattern-container" class="row animated fadeIn <?= $passwordOrPattern === 1 ? 'hidden' : '' ?>">
                            <div class="col-sm-8">
                                <div id="patternHolder" style="width: 100%;"></div>
                                <?= Html::hiddenInput('Workshop[pattern]', $model->pattern, ['id' => 'workshop-pattern']) ?>
                                <p style="margin-top: 10px;"><code style="font-size: 20px;" id="pattern-numbers"></code></p>
                                <button id="clear-pattern" type="button" class="btn btn-xs btn-danger"><i class="material-icons">delete</i> Limpiar</button>
                            </div>
                        </div>

                        <div class="form-group">
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
