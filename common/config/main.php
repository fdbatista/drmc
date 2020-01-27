<?php

return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'language' => 'es_ES',
    'components' => [
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        // uncomment if you want to cache RBAC items hierarchy
        // 'cache' => 'cache',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'thumbnailer' => [
            'class' => 'daxslab\thumbnailer\Thumbnailer',
            'defaultWidth' => 200,
            'defaultHeight' => 200,
            //'thumbnailsBasePath' => '@webroot/img/thumbs',
            'thumbnailsBaseUrl' => '@web/img/thumbs',
            'enableCaching' => true,
        ],
    ]
];
