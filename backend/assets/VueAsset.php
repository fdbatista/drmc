<?php

namespace backend\assets;

use yii\web\AssetBundle;

class VueAsset extends AssetBundle {

    public $sourcePath = '@app/../common/assets';
    public $css = [
        'plugins/vue/styles.css',
    ];
    public $js = [
        'plugins/vue/vue.min.js',
        'plugins/vue/axios.min.js',
        'plugins/vue/pre-diagnosis.js',
    ];
    public $depends = [
    ];

}
