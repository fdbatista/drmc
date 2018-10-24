<?php

namespace backend\assets;

use yii\web\AssetBundle;

class GifEncoderAsset extends AssetBundle {

    public $sourcePath = '@app/../common/assets';
    public $css = [
    ];
    public $js = [
        'plugins/jsgif/LZWEncoder.js',
        'plugins/jsgif/NeuQuant.js',
        'plugins/jsgif/GIFEncoder.js',
        'plugins/jsgif/b64.js',
    ];
    public $depends = [
        'backend\assets\Html2CanvasAsset',
    ];

}
