<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
//    require(__DIR__ . '/../../common/config/params-local.php'),
//    require(__DIR__ . '/params-local.php'),
    require(__DIR__ . '/params.php')
);

return [
    'id' => 'smile-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
//        'user' => [
//            'identityClass' => 'common\models\User',
//            'enableAutoLogin' => true,
//        ],
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
            /* @var \frontend\smile\components\SmileFrontendRequest */
            'class' => 'frontend\smile\components\SmileFrontendRequest',
            'frontendWebUrl'=> '/frontend/web',
        ],
        'urlManager' => [
            /* @var \frontend\smile\components\SmileFrontendUrlManager */
            'class'=>'frontend\smile\components\SmileFrontendUrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => true,
            'rules' => [
                ''=>'site/index',
                '<controller:[\w\d\-_]+>/<url:[\w\d_\/\-]+>'=>'<controller>/one',
                '<controller:[\w\d\-_]+>'=>'<controller>/index',
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
