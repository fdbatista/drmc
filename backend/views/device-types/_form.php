<?php

use common\models\DeviceType;
use common\models\StockType;
use common\utils\AttributesLabels;
use kartik\widgets\Select2;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $model DeviceType */
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
                            <div class="col-sm-8">
                                <?= $form->field($model, 'name', ['inputTemplate' => '<div class="form-group label-floating"><label class="control-label">' . AttributesLabels::getAttributeLabel('name') . '</label>{input}</div>'])->textInput(['maxlength' => true])->label(false) ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-8">
                                <?=
                                $form->field($model, 'stock_type_id')->widget(Select2::classname(), [
                                    'data' => ArrayHelper::map(StockType::find()->all(), 'id', 'name'),
                                    'language' => 'es',
                                    'options' => ['placeholder' => 'Seleccione un destino', 'class' => 'form-control'],
                                    'pluginOptions' => [
                                        'allowClear' => false
                                    ],
                                ])->label(false)
                                ?>
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
