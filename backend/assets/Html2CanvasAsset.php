<?php

namespace backend\assets;

use yii\web\AssetBundle;

class Html2CanvasAsset extends AssetBundle {

    public $sourcePath = '@app/../common/assets';
    public $css = [
    ];
    public $js = [
        'plugins/html2canvas/html2canvas.min.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];

}
