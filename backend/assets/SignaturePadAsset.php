<?php

namespace backend\assets;

use yii\web\AssetBundle;

class SignaturePadAsset extends AssetBundle {

    public $sourcePath = '@app/../common/assets';
    public $css = [
    ];
    public $js = [
        'plugins/signature_pad/signature_pad.min.js',
        'plugins/signature_pad/init.js',
    ];
    public $depends = [
        'backend\assets\GifEncoderAsset',
    ];

}
