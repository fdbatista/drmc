<?php

use common\models\Role;
use common\utils\AttributesLabels;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm as ActiveForm2;

/* @var $this View */
/* @var $model Role */
/* @var $form ActiveForm2 */

$this->registerJsFile('@web/js/roles-form-helper.js', ['depends' => 'backend\assets\AppAsset'])
?>

<div class="content">
    <div class="container-fluid">
        <?php $form = ActiveForm::begin(); ?>
        <?php include_once __DIR__ . '/../layouts/partials/model-errors.php'; ?>

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header" data-background-color="purple">
                        <h4 class="title"><?= $this->title ?></h4>
                        <p class="category">Complete el siguiente formulario</p>
                    </div>
                    <div class="card-content">
                        <div class="row">
                            <div class="col-xs-10">
                                <?= $form->field($model, 'name', ['inputTemplate' => '<div class="form-group label-floating"><label class="control-label">' . AttributesLabels::getAttributeLabel('name') . '</label>{input}</div>'])->textInput(['maxlength' => true, 'disabled' => !$isNewRole])->label(false) ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-10">
                                <?= $form->field($model, 'description', ['inputTemplate' => '<div class="form-group label-floating"><label class="control-label">' . AttributesLabels::getAttributeLabel('description') . '</label>{input}</div>'])->textarea(['maxlength' => true, 'class' => 'form-control'])->label(false) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" data-background-color="purple">
                        <h4 class="title">Permisos</h4>
                    </div>
                    <div class="card-content">
                        <div class="row">
                            <?php
                            foreach ($perms as $permKey => $permValue) {
                                ?>

                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-header" data-background-color="orange">
                                            <h4 class="title"><?= $permKey ?></h4>
                                        </div>

                                        <div class="card-content">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input class="chk-select-all" data-id="<?= $permKey ?>" type="checkbox" name="<?= $permKey . '-all' ?>" />
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td>Seleccionar todo</td>
                                                    </tr>
                                                    <?php
                                                    foreach ($permValue['perms'] as $permIndex => $permData) {
                                                        ?>
                                                        <tr>
                                                            <td>
                                                                <div class="checkbox">
                                                                    <label>
                                                                        <input data-parent="<?= $permKey ?>" type="checkbox" name="<?= $permIndex ?>" <?= $permData['value'] ? 'checked="checked"': ''?> />
                                                                    </label>
                                                                </div>
                                                            </td>
                                                            <td><?= $permData['name'] ?></td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="form-group">
                            <?= Html::submitButton(Yii::t('app', '<i class="material-icons">check</i> Aceptar'), ['class' => 'btn btn-primary pull-right']) ?>
                        </div>
                        <div class="clearfix"></div>

                    </div>
                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>

