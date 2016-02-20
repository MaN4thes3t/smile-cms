<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
//    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'language'=>'ru',
    'sourceLanguage'=>'ru',
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'request'=>[
            'class' => 'common\components\Request',
            'web'=> '/frontend/web'

        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                ''=>'site/main-page',
//                '<controller:news>/<category:\d+>/<news:\d+/>'=>'news/one',
//                '<controller:news>/<category:\d+/>'=>'news/index',
//                '<controller:news>/<action:\w+/>'=>'news/index',
//                '<controller:contacts>/<contact:\d+/>'=>'contacts/index',
                '<controller:news/>'=>'<controller>index',
                '<controller:news>/<id:\d+>'=>'news/one',
                '<controller:photo/>'=>'<controller>index',
                '<controller:partners/>'=>'<controller>index',
                '<controller:video/>'=>'<controller>index',
                '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
                '<translit:[\w_\/-]+>'=>'site/page',
            ]
        ],
        'assetManager' => [
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'jsOptions'=>[
                        'position'=>\yii\web\View::POS_HEAD,
                    ]
                ],
            ],
        ],
    ],
    'params' => $params,
];
