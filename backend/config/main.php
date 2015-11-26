<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/params.php')
);

return [
    'id' => 'smile-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'redactor' => [
            'class'=>'backend\smile\Redactor',
            'uploadDir' => '@img_root/uploads',
            'uploadUrl' => '/uploads',
            'imageAllowExtensions'=>['jpg','png','jpeg']
        ],
        'language' => [
            'class' => 'backend\modules\language\language',
        ],
        'poll' => [
            'class' => 'backend\modules\poll\poll',
        ],
        'advice' => [
            'class' => 'backend\modules\advice\advice',
        ],
        'newscategory' => [
            'class' => 'backend\modules\newscategory\newscategory',
        ],
        'dictionary' => [
            'class' => 'backend\modules\dictionary\dictionary',
        ],
        'tag' => [
            'class' => 'backend\modules\tag\tag',
        ],
        'leader' => [
            'class' => 'backend\modules\leader\leader',
        ],
        'page' => [
            'class' => 'backend\modules\page\page',
        ],
    ],
    'components' => [
        'request'=>[
            /* @var \backend\smile\components\SmileBackendRequest */
            'class' => 'backend\smile\components\SmileBackendRequest',
            'backendWebUrl'=> '/backend/web',
            'backendUrl' => '/backend'
        ],
        'user' => [
            /* @var \common\models\User */
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    /* @var \yii\log\FileTarget */
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            /* @var \backend\smile\components\SmileBackendUrlManager */
            'class'=>'backend\smile\components\SmileBackendUrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                '<module:\w+>/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>',
            ]
        ],
        'assetManager' => [
            'bundles' => [
                /* @var \yii\web\JqueryAsset */
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
