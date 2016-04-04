<?php
Yii::setAlias('@img_root', realpath(dirname(__FILE__).'/../../'));
Yii::setAlias('@images', '/images');
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
//    'bootstrap' => ['debug'],
    'modules' =>[
//        /* @var \yii\debug\Module */
//        'debug'=>'yii\debug\Module'
    ],
    'components' => [
        'image' => [
            /* @var \yii\image\ImageDriver */
            'class' => 'yii\image\ImageDriver',
            'driver' => 'GD',
        ],
        'request'=>[
            /* @var \common\smile\components\SmileCommonRequest */
            'cookieValidationKey' => 'iqTh78ppBnqlaM8RehWVv0lXvK1RkZvv',
        ],
        'db' => [
            /* @var \yii\db\Connection */
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=smile-cms',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ],
        'mailer' => [
            /* @var \yii\swiftmailer\Mailer */
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => true,
        ],
        'i18n' => [
            'translations' => [
                'backend' => [
                    /* @var \common\smile\components\SmileDbMessageSource */
                    'class' => 'common\smile\components\SmileDbMessageSource',
                    'sourceMessageTable' => 'dictionary',
                    'messageTable' => 'dictionary_translate',
                    'forceTranslation'=>true,
                ],
                'frontend' => [
                    /* @var \yii\i18n\DbMessageSource */
                    'class' => 'common\smile\components\SmileDbMessageSource',
                    'sourceMessageTable' => 'dictionary',
                    'messageTable' => 'dictionary_translate',
                    'forceTranslation'=>true,
                ]
            ],
        ],
        'cache' => [
            /* @var \yii\caching\FileCache */
            'class' => 'yii\caching\FileCache',
        ],
        'authManager' => [
            /* @var \yii\rbac\PhpManager */
            'class' => 'yii\rbac\PhpManager',
            'defaultRoles' => ['user','moder','admin'],
            'itemFile' => '@common/components/rbac/items.php',
            'assignmentFile' => '@common/components/rbac/assignments.php',
            'ruleFile' => '@common/components/rbac/rules.php'
        ],
    ],
];
