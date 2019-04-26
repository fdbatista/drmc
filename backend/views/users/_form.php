<?php

use common\models\User;
use common\utils\AttributesLabels;
use common\utils\StaticMembers;
use kartik\widgets\Select2;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $model User */
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
                            <div class="col-sm-4">
                                <?= $form->field($model, 'username', ['inputTemplate' => '<div class="form-group label-floating"><label class="control-label">' . AttributesLabels::getAttributeLabel('username') . '</label>{input}</div>'])->textInput(['maxlength' => true])->label(false) ?>
                            </div>
                            <div class="col-sm-4">
                                <?= $form->field($model, 'email', ['inputTemplate' => '<div class="form-group label-floating"><label class="control-label">' . AttributesLabels::getAttributeLabel('email') . '</label>{input}</div>'])->textInput(['maxlength' => true])->label(false) ?>
                            </div>
                            <div class="col-sm-4">
                                <?= $form->field($model, 'telephone', ['inputTemplate' => '<div class="form-group label-floating"><label class="control-label">' . AttributesLabels::getAttributeLabel('telephone') . '</label>{input}</div>'])->textInput(['maxlength' => true])->label(false) ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <?= $form->field($model, 'first_name', ['inputTemplate' => '<div class="form-group label-floating"><label class="control-label">' . AttributesLabels::getAttributeLabel('first_name') . '</label>{input}</div>'])->textInput(['maxlength' => true])->label(false) ?>
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($model, 'last_name', ['inputTemplate' => '<div class="form-group label-floating"><label class="control-label">' . AttributesLabels::getAttributeLabel('last_name') . '</label>{input}</div>'])->textInput(['maxlength' => true])->label(false) ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <?= $form->field($model, 'password', ['inputTemplate' => '<div class="form-group label-floating"><label class="control-label">' . AttributesLabels::getAttributeLabel('password') . '</label>{input}</div>'])->passwordInput(['maxlength' => true])->label(false) ?>
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($model, 'password_repeat', ['inputTemplate' => '<div class="form-group label-floating"><label class="control-label">' . AttributesLabels::getAttributeLabel('password_repeat') . '</label>{input}</div>'])->passwordInput(['maxlength' => true])->label(false) ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <?= $form->field($model, 'address', ['inputTemplate' => '<div class="form-group label-floating"><label class="control-label">' . AttributesLabels::getAttributeLabel('address') . '</label>{input}</div>'])->textarea(['maxlength' => true])->label(false) ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6 col-md-3">
                                <?=
                                $form->field($model, 'sex', ['inputTemplate' => '<div class="form-group label-floating"><label class="control-label">' . AttributesLabels::getAttributeLabel('sex') . '</label>{input}</div>'])->widget(Select2::classname(), [
                                    'data' => ['M' => 'Masculino', 'F' => 'Femenino'],
                                    'theme' => Select2::THEME_KRAJEE,
                                ])->label(false);
                                ?>
                            </div>

                            <?php
                            if ($model->id !== Yii::$app->user->identity->id) {
                                ?>
                                <div class="col-sm-6 col-md-3">
                                    <?=
                                    $form->field($model, 'status')->widget(Select2::classname(), [
                                        'data' => [10 => 'Activo', 0 => 'Inactivo'],
                                        'language' => 'es',
                                        'theme' => Select2::THEME_KRAJEE,
                                        'options' => ['placeholder' => AttributesLabels::getAttributeLabel('status')],
                                    ])->label(false)
                                    ?>
                                </div>
                                <div class="col-sm-6 col-md-3">
                                    <?=
                                    Select2::widget([
                                        'name' => 'role',
                                        'data' => StaticMembers::getRoles(),
                                        'language' => 'es',
                                        'theme' => Select2::THEME_KRAJEE,
                                        'options' => ['placeholder' => AttributesLabels::getAttributeLabel('role')],
                                        'value' => $model->getRole(),
                                    ])
                                    ?>
                                </div>
                                <div class="col-sm-6 col-md-3">
                                    <?=
                                    $form->field($model, 'branch_id')->widget(Select2::classname(), [
                                        'data' => \yii\helpers\ArrayHelper::map(\common\models\Branch::find()->all(), 'id', 'name'),
                                        'language' => 'es',
                                        'theme' => Select2::THEME_KRAJEE,
                                        'options' => ['placeholder' => AttributesLabels::getAttributeLabel('branch_id')],
                                    ])->label(false)
                                    ?>
                                </div>
                            <?php }
                            ?>
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
