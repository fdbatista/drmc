<?php

use backend\assets\DatePickerAsset;
use common\models\Sale;
use common\utils\AttributesLabels;
use common\utils\StaticMembers;
use kartik\widgets\Select2;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\web\View;

DatePickerAsset::register($this);
/* @var $this View */
/* @var $model Sale */
/* @var $form ActiveForm */
?>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
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
                                <div class="form-group">
                                    <?= $form->field($model, 'date', ['inputTemplate' => '<div class="form-group label-floating"><label class="control-label">' . AttributesLabels::getAttributeLabel('date') . '</label>{input}</div>'])->textInput(['maxlength' => true, 'class' => 'datetimepicker form-control', 'readonly' => 'readonly'])->label(false) ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <?=
                                $form->field($model, 'customer_id')->widget(Select2::classname(), [
                                    'data' => StaticMembers::getUsersByRole('customer'),
                                    'language' => 'es',
                                    'options' => ['placeholder' => AttributesLabels::getAttributeLabel('customer_id'), 'class' => 'form-control'],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                ])->label(false)
                                ?>
                                </div>
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
