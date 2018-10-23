<?php

use common\models\SaleItem;
use common\utils\AttributesLabels;
use common\utils\StaticMembers;
use kartik\depdrop\DepDrop;
use kartik\widgets\Select2;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

/* @var $this View */
/* @var $model SaleItem */
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
                        <?php $form = ActiveForm::begin(['id' => 'items-form']); ?>
                        <?php include_once __DIR__ . '/../layouts/partials/model-errors.php'; ?>
                        <div class="row">
                            <div class="col-sm-10">
                                <?=
                                $form->field($model, 'type_id')->widget(Select2::classname(), [
                                    'data' => StaticMembers::getDevicesForSale(),
                                    'language' => 'es',
                                    'options' => ['onchange' =>'updatePriceWithDiscounts();', 'id' => 'type-id', 'placeholder' => 'Seleccione un tipo', 'class' => 'form-control'],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                ])->label(false)
                                ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-10">
                                <?=
                                $form->field($model, 'model_id')->widget(DepDrop::classname(), [
                                    'type' => DepDrop::TYPE_SELECT2,
                                    'data' => [],
                                    'language' => 'es',
                                    'options' => ['onchange' =>'updatePriceWithDiscounts();', 'id' => 'model-id', 'placeholder' => 'Seleccione un modelo', 'class' => 'form-control'],
                                    'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                                    'pluginOptions' => [
                                        'depends' => ['type-id'],
                                        'url' => Url::to(['/sales/get-brand-models-for-sale']),
                                    ]
                                ])->label(false)
                                ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-2">
                                <?= $form->field($model, 'items', ['inputTemplate' => '<div class="form-group label-floating"><label class="control-label">' . AttributesLabels::getAttributeLabel('items') . '</label>{input}</div>'])->textInput(['maxlength' => true, 'class' => 'form-control', 'onblur' => 'updatePriceWithDiscounts()'])->label(false)->error(false) ?>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group label-floating">
                                    <label class="control-label">Precio por unidad</label>
                                    <?= Html::input('text', null, '0', ['id' => 'public-price', 'readonly' => true, 'class' => 'form-control']) ?>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group label-floating">
                                    <label class="control-label">Importe total</label>
                                    <?= Html::input('text', null, '0', ['id' => 'total-price', 'readonly' => true, 'class' => 'form-control']) ?>
                                </div>
                            </div>
                        </div>

                        <div class="row" style="margin-top: 10px;">
                            <div class="col-sm-12">
                                <p style="color: gray;">
                                    Descuento inicial: <code id="first-discount">$0.00</code>, importe: <code id="first-discount-price">$0.00</code><br/>
                                    Descuento mayor: <code id="major-discount">$0.00</code>, importe: <code id="major-discount-price">$0.00</code>
                                </p>
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
        function resetForm() {
            alert(123);
        }
        function updatePriceWithDiscounts() {
            var items = $('#<?= Html::getInputId($model, 'items') ?>').val();
            var type_id = $('#type-id').select2("val");
            var model_id = $('#model-id').select2("val");
            var csrfToken = $('meta[name="csrf-token"]').attr("content");
            console.clear();
            console.log(type_id);
            console.log(model_id);

            if (items && type_id && model_id && items && items > 0) {
                $.ajax({
                    url: '<?= Url::to(['sales/calculate-price-with-discounts']) ?>',
                    data: {items: items, type_id: type_id, model_id: model_id, _csrf: csrfToken, XDEBUG_SESSION_START: 'netbeans-xdebug'},
                    type: 'POST',
                    dataType: 'json',
                    success: function (response) {
                        console.log(response);
                        $('#public-price').val(response.publicPrice);
                        $('#total-price').val(response.overallPrice);
                        $('#first-discount').html('$' + response.firstDiscount);
                        $('#major-discount').html('$' + response.majorDiscount);
                        $('#first-discount-price').html('$' + response.priceWithFirstDiscount);
                        $('#major-discount-price').html('$' + response.priceWithMajorDiscount);
                    },
                    error: function (jqXHR, status, error) {

                    },
                    complete: function (jqXHR, status) {

                    }
                });
            } else {
                $('#<?= Html::getInputId($model, 'items') ?>').val(0);
                $('#public-price').val(0);
                $('#total-price').val(0);
                $('#first-discount').html('$0.00');
                $('#major-discount').html('$0.00');
                $('#first-discount-price').html('$0.00');
                $('#major-discount-price').html('$0.00');
            }
        };
    </script>
</div>
