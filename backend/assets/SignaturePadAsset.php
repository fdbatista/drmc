<?php

namespace backend\assets;

use yii\web\AssetBundle;

class SignaturePadAsset extends AssetBundle {

    public $sourcePath = '@app/../common/assets';
    public $css = [
    ];
    public $js = [
        'plugins/jsgif/LZWEncoder.js',
        'plugins/jsgif/NeuQuant.js',
        'plugins/jsgif/GIFEncoder.js',
        'plugins/jsgif/b64.js',
        'plugins/signature_pad/signature_pad.min.js',
        'plugins/signature_pad/init.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];

}
