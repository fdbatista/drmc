<?php

use common\models\BrandModel;
use common\utils\AttributesLabels;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\DetailView;

/* @var $this View */
/* @var $model BrandModel */

$this->title = $model->name;
$brand = $model->getBrand()->one();
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Marcas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $brand->name, 'url' => ['view', 'id' => $brand->id]];
$this->params['breadcrumbs'][] = ['label' => 'Modelos', 'url' => ['index-models', 'id' => $brand->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="brand-model-view">

    <!--<h3><?= Html::encode($this->title) ?></h3>-->

    <p>
        <?= Html::a('<i class="material-icons">update</i> ' . Yii::t('app', 'Actualizar'), ['update-models', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a('<i class="material-icons">delete</i> ' . Yii::t('app', 'Eliminar'), ['delete-models', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Confirme que desa eliminar este elemento'),
                'method' => 'post',
            ],
        ])
        ?>
    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
                [
                'attribute' => 'name',
                'label' => AttributesLabels::getAttributeLabel('name'),
            ],
                [
                'attribute' => 'name',
                'label' => AttributesLabels::getAttributeLabel('description'),
            ],
        ],
    ])
    ?>

</div>
