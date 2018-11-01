<?php

use backend\assets\DateTimePickerAsset;
use common\models\Sale;
use common\utils\AttributesLabels;
use common\utils\StaticMembers;
use kartik\widgets\Select2;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

DateTimePickerAsset::register($this);
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
                                <?= $form->field($model, 'date', ['inputTemplate' => '<div class="form-group label-floating"><label class="control-label">' . AttributesLabels::getAttributeLabel('date') . '</label>{input}</div>'])->textInput(['maxlength' => true, 'class' => 'datetimepicker form-control', 'readonly' => 'readonly'])->label(false) ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <?=
                                    Select2::widget([
                                        'id' => 'client-type',
                                        'name' => 'client-type',
                                        'data' => [1 => 'Nuevo cliente', 2 => 'Cliente existente'],
                                        'value' => $clientType,
                                        'pluginEvents' => [
                                            "select2:select" => 'function() {if ($(this).val() === "1") {$("#new-client").removeClass("hidden");$("#old-client").addClass("hidden");} else {$("#old-client").removeClass("hidden");$("#new-client").addClass("hidden");}}',
                                        ]
                                    ])
                                    ?>
                                </div>
                            </div>
                        </div>

                        <div class="row <?= $clientType === 1 ? 'hidden' : '' ?>" id="old-client">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <?=
                                    $form->field($model, 'customer_id')->widget(Select2::classname(), [
                                        'data' => StaticMembers::getCustomers(),
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

                        <div class="row <?= $clientType === 1 ? '' : 'hidden' ?>" id="new-client">
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-10">
                                        <?= Html::textInput('Sale[client-name]', null, ['id' => 'txt-new-name', 'class' => 'form-control', 'placeholder' => 'Nombre']) ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-5">
                                        <?= Html::textInput('Sale[client-telephone]', null, ['id' => 'txt-new-telephone', 'class' => 'form-control', 'placeholder' => 'Teléfono']) ?>
                                    </div>
                                    <div class="col-sm-5">
                                        <?= Html::textInput('Sale[client-code]', null, ['id' => 'txt-new-code', 'class' => 'form-control', 'placeholder' => 'Código', 'readonly' => true]) ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-5 col-sm-offset-5">
                                        <button onclick="generateNewCustomer()" id="btn-new-code" class="btn btn-xs btn-info" type="button"><i class="material-icons">refresh</i> Nuevo c&oacute;digo</button>
                                    </div>
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
    <script type="text/javascript">
        function generateNewCustomer() {
            var csrfToken = $('meta[name="csrf-token"]').attr("content");
            var name = $('#txt-new-name').val();
            var telephone = $('#txt-new-telephone').val();
            if (name && telephone) {
                $('#btn-new-code').prop('disabled', true);
                $.ajax({
                    url: '<?= Url::to(['customers/generate-new-customer']) ?>',
                    data: {_csrf: csrfToken, name: name, telephone: telephone, XDEBUG_SESSION_START: 'netbeans-xdebug'},
                    type: 'GET',
                    dataType: 'json',
                    success: function (json) {
                        $('#txt-new-code').val(json);
                        $('#btn-new-code').html('Código generado');
                        $('#btn-new-code').removeClass('btn-info').addClass('btn-danger');
                    },
                    error: function (jqXHR, status, error) {
                        alert(jqXHR.responseJSON.message);
                        $('#btn-new-code').prop('disabled', false);
                    },
                    complete: function (jqXHR, status) {

                    }
                });
            } else {
                alert('Debe introducir un nombre y un teléfono');
            }
        }
    </script>
</div>
