<?php

use yii\helpers\Url;
use yii\web\View;

/* @var $this View */

$this->title = Yii::t('app', 'Roles');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="role-index">
    
    <p>
        <?php /*echo Html::a('<i class="material-icons">add</i> ' . Yii::t('app', 'Agregar rol'), ['create'], ['class' => 'btn btn-success'])*/ ?>
    </p>

    <div id="w0" class="grid-view">
        <div class="summary">Mostrando <b><?= count($roles) ?></b> elementos.</div>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th><a>Nombre</a></th>
                    <th><a>Descripci&oacute;n</a></th>
                    <!--<th><a>Acciones</a></th>-->
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($roles as $role) {
                    ?>
                    <tr>
                        <td><?= $role->name ?></td>
                        <td><?= $role->description ?></td>
                        <!--<td><a href="<?= Url::to(['roles/update', 'id' => $role->name]) ?>" data-toggle="tooltip" data-placement="top" title="Actualizar"><span class="glyphicon glyphicon-pencil"></span></a></td>-->
                    </tr>
                    <?php
                }
                ?>

            </tbody>
        </table>
    </div>
</div>
