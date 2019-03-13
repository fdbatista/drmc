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
            if (isset(Yii::$app->authManager->getRolesByUser(Yii::$app->user->identity->id)['admin'])) {
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
            } else {
                ?>
                    <div class="row">
                    <div class="col-md-8 col-lg-6">
                        <p class="alert alert-warning"><i class="fa fa-info-circle"></i> El administrador del sistema no le ha asignado a ninguna sucursal</p>
                    </div>
                    </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>
