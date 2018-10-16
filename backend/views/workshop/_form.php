<?php

use common\models\DeviceType;
use common\models\User;
use common\models\Workshop;
use common\utils\AttributesLabels;
use common\utils\StaticMembers;
use kartik\widgets\Select2;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $model Workshop */
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
                            <div class="col-md-12">
                                <div class="form-group">
                                    <?= $form->field($model, 'pre_diagnosis', ['inputTemplate' => '<div class="form-group label-floating"><label class="control-label">' . AttributesLabels::getAttributeLabel('pre_diagnosis') . '</label>{input}</div>'])->textarea(['maxlength' => true, 'class' => 'form-control'])->label(false)->error(false) ?>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <?= $form->field($model, 'observations', ['inputTemplate' => '<div class="form-group label-floating"><label class="control-label">' . AttributesLabels::getAttributeLabel('observations') . '</label>{input}</div>'])->textarea(['maxlength' => true, 'class' => 'form-control'])->label(false)->error(false) ?>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <?= $form->field($model, 'effort', ['inputTemplate' => '<div class="form-group label-floating"><label class="control-label">' . AttributesLabels::getAttributeLabel('effort') . '</label>{input}</div>'])->textInput(['maxlength' => true])->label(false)->error(false) ?>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <?= $form->field($model, 'signature_in', ['inputTemplate' => '<div class="form-group label-floating"><label class="control-label">' . AttributesLabels::getAttributeLabel('signature_in') . '</label>{input}</div>'])->textInput(['maxlength' => true])->label(false)->error(false) ?>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <?= $form->field($model, 'signature_out', ['inputTemplate' => '<div class="form-group label-floating"><label class="control-label">' . AttributesLabels::getAttributeLabel('signature_out') . '</label>{input}</div>'])->textInput(['maxlength' => true])->label(false)->error(false) ?>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <?= $form->field($model, 'password_pattern', ['inputTemplate' => '<div class="form-group label-floating"><label class="control-label">' . AttributesLabels::getAttributeLabel('password_pattern') . '</label>{input}</div>'])->textInput(['maxlength' => true])->label(false)->error(false) ?>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <?=
                                    $form->field($model, 'receiver_id')->widget(Select2::classname(), [
                                        'data' => ArrayHelper::map(User::find()->orderBy(['username' => SORT_ASC])->all(), 'id', 'email'),
                                        'language' => 'es',
                                        'options' => ['placeholder' => 'Seleccione un usuario', 'class' => 'form-control'],
                                        'pluginOptions' => [
                                            'allowClear' => true
                                        ],
                                    ])
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


<?php $form = ActiveForm::begin(); ?>



<div class="form-group">
    <?= Html::submitButton(Yii::t('app', 'Aceptar'), ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>

