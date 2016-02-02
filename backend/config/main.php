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
        'dropzone' => [
            'class' => 'backend\smile\modules\dropzone\SmileDropZoneModule',
        ],
        'redactor' => [
            'class'=>'backend\smile\modules\redactor\SmileRedactorModule',
            'uploadDir' => '@img_root/uploads',
            'uploadUrl' => '/uploads',
            'imageAllowExtensions'=>['jpg','png','jpeg']
        ],
        'language' => [
            'class' => 'backend\modules\language\Language',
        ],
        'poll' => [
            'class' => 'backend\modules\poll\Poll',
        ],
        'advice' => [
            'class' => 'backend\modules\advice\Advice',
        ],
        'newscategory' => [
            'class' => 'backend\modules\newscategory\Newscategory',
        ],
        'dictionary' => [
            'class' => 'backend\modules\dictionary\Dictionary',
        ],
        'tag' => [
            'class' => 'backend\modules\tag\Tag',
        ],
        'leader' => [
            'class' => 'backend\modules\leader\Leader',
        ],
        'news' => [
            'class' => 'backend\modules\news\News',
        ],
        'page' => [
            'class' => 'backend\modules\page\Page',
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
