<?php

use common\models\BrandModel;
use common\models\Device;
use common\models\DeviceType;
use common\utils\StaticMembers;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $model Device */
/* @var $form ActiveForm */
?>

<div class="device-form">

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

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Aceptar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
