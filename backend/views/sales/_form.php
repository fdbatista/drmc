<?php

use common\models\DeviceType;
use common\models\Sale;
use common\utils\StaticMembers;
use kartik\widgets\Select2;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $model Sale */
/* @var $form ActiveForm */
?>

<div class="sale-form">

    <?php $form = ActiveForm::begin(); ?>

    <?=
    $form->field($model, 'type_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(DeviceType::find()->all(), 'id', 'name'),
        'language' => 'es',
        'options' => ['placeholder' => 'Seleccione un tipo', 'class' => 'form-control'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])
    ?>

    <?=
    $form->field($model, 'model_id')->widget(Select2::classname(), [
        'data' => StaticMembers::getModelsAndBrand(),
        'language' => 'es',
        'options' => ['placeholder' => 'Seleccione un modelo', 'class' => 'form-control'],
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
