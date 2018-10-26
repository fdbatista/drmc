<?php

use backend\assets\DatePickerAsset;
use common\models\Workshop;
use common\utils\AttributesLabels;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\web\View;

DatePickerAsset::register($this);

/* @var $this View */
/* @var $model Workshop */
/* @var $form ActiveForm */

$this->registerJs("setLockPattern('" . $model->pattern . "')");
$this->title = Yii::t('app', 'Cerrar reparación');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Reparaciones'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Datos del dispositivo'), 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Cerrar reparación');
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

                        <div class="row">
                            <div class="col-sm-4">
                                <?= $form->field($model, 'customer_name', ['inputTemplate' => '<div class="form-group label-floating"><label class="control-label">' . AttributesLabels::getAttributeLabel('customer_name') . '</label>{input}</div>'])->textInput(['maxlength' => true])->label(false) ?>
                            </div>
                            <div class="col-sm-4">
                                <?= $form->field($model, 'customer_telephone', ['inputTemplate' => '<div class="form-group label-floating"><label class="control-label">' . AttributesLabels::getAttributeLabel('customer_telephone') . '</label>{input}</div>'])->textInput(['maxlength' => true])->label(false) ?>
                            </div>
                            <div class="col-md-4">
                                <?= $form->field($model, 'warranty_until', ['inputTemplate' => '<div class="form-group label-floating"><label class="control-label">' . AttributesLabels::getAttributeLabel('warranty_until') . '</label>{input}</div>'])->textInput(['maxlength' => true, 'class' => 'datetimepicker form-control', 'readonly' => 'readonly'])->label(false) ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                <?= $form->field($model, 'discount_applied', ['inputTemplate' => '<div class="form-group label-floating"><label class="control-label">' . AttributesLabels::getAttributeLabel('discount_applied') . '</label>{input}</div>'])->textInput(['maxlength' => true])->label(false) ?>
                            </div>
                            <div class="col-sm-4">
                                <?= $form->field($model, 'final_price', ['inputTemplate' => '<div class="form-group label-floating"><label class="control-label">' . AttributesLabels::getAttributeLabel('final_price') . '</label>{input}</div>'])->textInput(['maxlength' => true])->label(false) ?>
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
