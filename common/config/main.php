<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            /* @var \yii\caching\FileCache */
            'class' => 'yii\caching\FileCache',
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
    ],
];
