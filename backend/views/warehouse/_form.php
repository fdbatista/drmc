<?php

use common\models\Warehouse;
use common\utils\StaticMembers;
use kartik\widgets\Select2;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $model Warehouse */
/* @var $form ActiveForm */
?>

<div class="warehouse-form">

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

    <?= $form->field($model, 'items')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price_in')->textInput() ?>

<?= $form->field($model, 'price_public')->textInput() ?>

    <div class="form-group">
<?= Html::submitButton(Yii::t('app', 'Aceptar'), ['class' => 'btn btn-success']) ?>
    </div>

<?php ActiveForm::end(); ?>

</div>
