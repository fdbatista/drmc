<?php

use common\models\User;
use common\utils\AttributesLabels;
use kartik\widgets\Select2;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\ActiveForm as ActiveForm2;

/* @var $this View */
/* @var $model User */
/* @var $form ActiveForm2 */

$this->title = 'Mi perfil';
$roles = Yii::$app->authManager->getRolesByUser($model->id);
$role = $model->getRoleObject();
?>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header" data-background-color="purple">
                        <h4 class="title">Mi Perfil</h4>
                        <p class="category">Complete sus datos</p>
                    </div>
                    <div class="card-content">
                        <?php $form = ActiveForm::begin(); ?>
                        <div class="row">
                            <div class="col-sm-3">
                                <?= $form->field($model, 'username', ['inputTemplate' => '<div class="form-group label-floating"><label class="control-label">' . AttributesLabels::getAttributeLabel('username') . '</label>{input}</div>'])->textInput(['maxlength' => true])->label(false) ?>
                            </div>
                            <div class="col-sm-4">
                                <?= $form->field($model, 'email', ['inputTemplate' => '<div class="form-group label-floating"><label class="control-label">' . AttributesLabels::getAttributeLabel('email') . '</label>{input}</div>'])->textInput(['maxlength' => true])->label(false) ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($model, 'telephone', ['inputTemplate' => '<div class="form-group label-floating"><label class="control-label">' . AttributesLabels::getAttributeLabel('telephone') . '</label>{input}</div>'])->textInput(['maxlength' => true])->label(false) ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-5">
                                <?= $form->field($model, 'first_name', ['inputTemplate' => '<div class="form-group label-floating"><label class="control-label">' . AttributesLabels::getAttributeLabel('first_name') . '</label>{input}</div>'])->textInput(['maxlength' => true])->label(false) ?>
                            </div>
                            <div class="col-md-5">
                                <?= $form->field($model, 'last_name', ['inputTemplate' => '<div class="form-group label-floating"><label class="control-label">' . AttributesLabels::getAttributeLabel('last_name') . '</label>{input}</div>'])->textInput(['maxlength' => true])->label(false) ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-10">
                                <?= $form->field($model, 'address', ['inputTemplate' => '<div class="form-group label-floating"><label class="control-label">' . AttributesLabels::getAttributeLabel('address') . '</label>{input}</div>'])->textInput(['maxlength' => true])->label(false) ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <?=
                                $form->field($model, 'sex', ['inputTemplate' => '<div class="form-group label-floating"><label class="control-label">' . AttributesLabels::getAttributeLabel('sex') . '</label>{input}</div>'])->widget(Select2::classname(), [
                                    'data' => ['M' => 'Masculino', 'F' => 'Femenino'],
                                    'pluginEvents' => [
                                        "select2:select" => 'function() { let newSex = $(this).val(); $("#role_avatar").attr("src", newSex === "M" ? "' . Url::to('@web/img/male.png') . '" : "' . Url::to('@web/img/female.png') . '");    }',
                                    ]
                                ])->label(false);
                                ?>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Zona horaria</label>
                                    <?=
                                    Select2::widget([
                                        'id' => 'time_zone',
                                        'name' => 'time_zone',
                                        'data' => $timeZones,
                                        'value' => $model->getUserData('time_zone'),
                                    ])
                                    ?>
                                </div>
                            </div>
                        </div>

                        <?= Html::submitButton(Yii::t('app', '<i class="material-icons">check</i> Actualizar'), ['class' => 'btn btn-primary pull-right']) ?>
                        <div class="clearfix"></div>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-profile">
                    <div class="card-avatar">
                        <a href="#pablo">
                            <?= Html::img('@web/img/' . ($model->sex === 'F' ? 'fe' : '') . 'male.png', ['id' => 'role_avatar', 'class' => 'img']) ?>
                        </a>
                    </div>

                    <div class="content">
                        <h6 class="category text-gray"><?= $role->name ?></h6>
                        <h4 class="card-title"><?= $model->first_name ?></h4>
                        <p class="card-content"><?= $role->description ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
