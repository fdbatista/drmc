<?php

use common\models\Device;
use common\models\Shop;
use common\utils\StaticMembers;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $model Shop */
/* @var $form ActiveForm */
?>

<div class="shop-form">

    <?php $form = ActiveForm::begin(); ?>

    <?=
    $form->field($model, 'device_id')->widget(Select2::classname(), [
        'data' => StaticMembers::getDevices(),
        'language' => 'es',
        'theme' => Select2::THEME_BOOTSTRAP,
        'options' => ['placeholder' => 'Seleccione un elemento'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])
    ?>

    <?= $form->field($model, 'inventory')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'items')->textInput() ?>
    
    <?= $form->field($model, 'price_in')->textInput() ?>

    <?= $form->field($model, 'price_out')->textInput() ?>

    <?= $form->field($model, 'first_discount')->textInput() ?>

    <?= $form->field($model, 'major_discount')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Aceptar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
