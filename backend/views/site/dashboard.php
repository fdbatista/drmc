<?php
/* @var $this yii\web\View */

$this->registerJs('demo.initDashboardPageCharts();');
$this->title = 'Administración';
$salesInfo = $data['sales'];
$currSalesInfo = $salesInfo['currentInfo'];

$soldProducts = $data['sold_products'];
$soldProductsType = count($soldProducts);

$workshopInfo = $data['workshop'];
$currWorkshopInfo = $workshopInfo['currentInfo'];
?>


<div class="content">

    <?php
    /*
      $items = [
      [
      'title' => 'Sintel',
      'href' => 'http://media.w3.org/2010/05/sintel/trailer.mp4',
      'type' => 'video/mp4',
      'poster' => 'http://media.w3.org/2010/05/sintel/poster.png'
      ],
      [
      'title' => 'Big Buck Bunny',
      'href' => 'http://upload.wikimedia.org/wikipedia/commons/7/75/Big_Buck_Bunny_Trailer_400p.ogg',
      'type' => 'video/ogg',
      'poster' => 'http://upload.wikimedia.org/wikipedia/commons/thumb/7/70/Big.Buck.Bunny.-.Opening.Screen.png/' .
      '800px-Big.Buck.Bunny.-.Opening.Screen.png'
      ]
      ];

      dosamigos\gallery\Carousel::widget([
      'items' => $items, 'json' => true,
      'clientEvents' => [
      'onslide' => 'function(index, slide) {
      console.log(slide);
      }'
      ]]);
     */
    ?>


    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12 col-lg-10">
                <div class="card">
                    <div class="card-header" data-background-color="green">
                        <h4 class="title"><i class="material-icons">build</i> Reparaciones</h4>
                        <p class="category">Ingresos por per&iacute;odo de tiempo</p>
                    </div>
                    <div class="card-content">
                        <?php foreach ($currWorkshopInfo as $currWorkshopInfoObj) { ?>
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <div class="card-stats">
                                    <div class="card-footer" style="margin-top: 30px;">
                                        <p class="category"><i class="material-icons">date_range</i> <?= $currWorkshopInfoObj['title'] ?></p>
                                        <h5 class="title">Ingresos: $<?= $currWorkshopInfoObj['data'] ? $currWorkshopInfoObj['data']->amount : "0" ?></h5>
                                        <h5 class="title">Ganancia: $<?= $currWorkshopInfoObj['data'] ? $currWorkshopInfoObj['data']->profit : "0" ?></h5>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 col-lg-10">
                <div class="card">
                    <div class="card-header" data-background-color="green">
                        <h4 class="title"><i class="material-icons">card_giftcard</i> Ventas</h4>
                        <p class="category">Ventas por per&iacute;odo de tiempo</p>
                    </div>
                    <div class="card-content">
                        <?php foreach ($currSalesInfo as $currSaleInfo) { ?>
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <div class="card card-stats">
                                    <div class="card-footer" style="margin-top: 30px;">
                                        <p class="category"><i class="material-icons">date_range</i> <?= $currSaleInfo['title'] ?></p>
                                        <h5 class="title">Ingresos: $<?= $currSaleInfo['data'] ? $currSaleInfo['data']->amount : "0" ?></h5>
                                        <h5 class="title">Ganancia: $<?= $currSaleInfo['data'] ? $currSaleInfo['data']->profit : "0" ?></h5>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">

        </div>

        <div class="row">
            <div class="col-sm-8">
                <div class="card card-nav-tabs">
                    <div class="card-header" data-background-color="purple">

                        <div class="nav-tabs-navigation">
                            <div class="nav-tabs-wrapper">
                                <h4 class="title">Productos m&aacute;s vendidos</h4>
                                <ul class="nav nav-tabs" data-tabs="tabs">
                                    <?php
                                    for ($i = 0; $i < $soldProductsType; $i++) {
                                        $soldProduct = $soldProducts[$i]
                                        ?>
                                        <li class="<?= $i === 0 ? 'active' : '' ?>">
                                            <a href="#<?= $soldProduct['id'] ?>" data-toggle="tab">
                                                <i class="material-icons">date_range</i> <?= $soldProduct['title'] ?>
                                                <div class="ripple-container"></div>
                                            </a>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="card-content">
                        <div class="tab-content">

                            <?php
                            for ($i = 0; $i < $soldProductsType; $i++) {
                                $soldProduct = $soldProducts[$i]
                                ?>

                                <div class="tab-pane<?= $i === 0 ? ' active' : '' ?>" id="<?= $soldProduct['id'] ?>">
                                    <table class="table table-hover">
                                        <thead class="text-warning">
                                        <th>Producto</th>
                                        <th>Unidades</th>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $rows = $soldProduct['data'];
                                            foreach ($rows as $row) {
                                                ?>
                                                <tr>
                                                    <td><?= $row->product ?></td>
                                                    <td><?= $row->sold_items ?></td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header card-chart" data-background-color="green">
                        <div class="ct-chart" id="dailySalesChart"></div>
                    </div>
                    <div class="card-content">
                        <p class="category">&Uacute;ltimos d&iacute;as</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header card-chart" data-background-color="orange">
                        <div class="ct-chart" id="emailsSubscriptionChart"></div>
                    </div>
                    <div class="card-content">
                        <p class="category">&Uacute;ltimas semanas</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header card-chart" data-background-color="red">
                        <div class="ct-chart" id="completedTasksChart"></div>
                    </div>
                    <div class="card-content">
                        <p class="category">&Uacute;ltimos meses</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
