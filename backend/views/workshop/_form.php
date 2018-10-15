<?php

use common\models\DeviceType;
use common\models\Workshop;
use common\utils\StaticMembers;
use kartik\widgets\Select2;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $model Workshop */
/* @var $form ActiveForm */
?>

<div class="workshop-form">

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

    <?= $form->field($model, 'pre_diagnosis')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password_pattern')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'observations')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'signature_in')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'signature_out')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'effort')->textInput() ?>

    <?= $form->field($model, 'receiver_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Aceptar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
