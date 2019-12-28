<?php

use common\models\Sale;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

/* @var $this View */
/* @var $model Sale */
/* @var $form ActiveForm */

$this->title = 'Dispositivos';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ventas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Detalles de la venta'), 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile('@web/js/sales-items-helper.js', ['depends' => 'yii\web\JqueryAsset']);

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
                        
                        <?php include_once __DIR__ . '/../layouts/partials/model-errors.php'; ?>
                        
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">C&oacute;digo</label>
                                    <input id="new-item-code" class="form-control" autofocus />
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group label-floating">
                                    <button id="btn-add-item" class="btn btn-primary btn-sm">+</button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <?= Html::hiddenInput('sale_id', $model->id, ['id' => 'sale_id']) ?>
                            <div class="col-sm-3">
                                <span class="text-uppercase underline">Producto</span>
                            </div>
                            <div class="col-sm-3">
                                <span class="text-uppercase underline">Modelo</span>
                            </div>
                            <div class="col-sm-2">
                                <span class="text-uppercase underline">Precio</span>
                            </div>
                            <div class="col-sm-3">
                                <span class="text-uppercase underline">Cantidad</span>
                            </div>
                        </div>
                        <div id="cart-items">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function updatePriceWithDiscounts() {
            var items = $('#<?= Html::getInputId($model, 'items') ?>').val();
            var discountApplied = $('#<?= Html::getInputId($model, 'discount_applied') ?>').val();
            var type_id = $('#type-id').select2("val");
            var model_id = $('#model-id').select2("val");
            var csrfToken = $('meta[name="csrf-token"]').attr("content");
            console.clear();

            if (items && type_id && model_id && items && items > 0) {
                $.ajax({
                    url: '<?= Url::to(['sales/calculate-price-with-discounts']) ?>',
                    data: {items: items, discount_applied: discountApplied, type_id: type_id, model_id: model_id, _csrf: csrfToken, XDEBUG_SESSION_START: 'netbeans-xdebug'},
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
        }
        ;
    </script>
</div>
