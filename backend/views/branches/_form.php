<?php

use common\models\Branch;
use common\utils\AttributesLabels;
use yii\helpers\Html;
use yii\web\View;
use yii\bootstrap\ActiveForm;

/* @var $this View */
/* @var $model Branch */
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
                            <div class="col-xs-10">
                                <?= $form->field($model, 'name', ['inputTemplate' => '<div class="form-group label-floating"><label class="control-label">' . AttributesLabels::getAttributeLabel('name') . '</label>{input}</div>'])->textInput(['maxlength' => true, 'autofocus' =>true])->label(false) ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <?= $form->field($model, 'description', ['inputTemplate' => '<div class="form-group label-floating"><label class="control-label">' . AttributesLabels::getAttributeLabel('description') . '</label>{input}</div>'])->textarea(['maxlength' => true, 'class' => 'form-control'])->label(false) ?>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <?= $form->field($model, 'phone_number', ['inputTemplate' => '<div class="form-group label-floating"><label class="control-label">' . AttributesLabels::getAttributeLabel('phone_number') . '</label>{input}</div>'])->textarea(['maxlength' => true, 'class' => 'form-control'])->label(false) ?>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <?= $form->field($model, 'address', ['inputTemplate' => '<div class="form-group label-floating"><label class="control-label">' . AttributesLabels::getAttributeLabel('address') . '</label>{input}</div>'])->textarea(['maxlength' => true, 'class' => 'form-control'])->label(false) ?>
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
