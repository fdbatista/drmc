<?php

use common\models\Branch;
use yii\helpers\Html;
use yii\web\View;
/* @var $this View */

$this->title = 'Administración';
?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <?php
            $branches = Branch::find()->all();

            if (count($branches) > 0) {
                echo '<div class="text-center"><h5>Seleccione la sucursal que desea administrar</h5><p>';
                foreach ($branches as $branch) {
                    echo Html::a("<i class='material-icons'>group_work</i> $branch->name", ['set-branch', 'id' => $branch->id], ['class' => 'btn btn-info']);
                }
                echo '</p></div>';
            } else {
                ?>
                    <h5 class="text-center">Debe registrar al menos una sucursal para poder trabajar con el sistema.</h5>
                    <p class="text-center"><?= Html::a('<i class="material-icons">add</i> ' . Yii::t('app', 'Agregar sucursal'), ['/branches/create'], ['class' => 'btn btn-info']) ?></p>
                <?php
            }
            ?>
        </div>
    </div>
</div>
