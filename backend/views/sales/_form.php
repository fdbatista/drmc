<?php

use common\models\Sale;
use common\utils\StaticMembers;
use kartik\widgets\Select2;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $model Sale */
/* @var $form ActiveForm */
?>

<div class="sale-form">

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

    <?= $form->field($model, 'price_in')->textInput() ?>

    <?= $form->field($model, 'price_out')->textInput() ?>

    <?= $form->field($model, 'items')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
