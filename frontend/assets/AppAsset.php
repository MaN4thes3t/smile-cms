<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        '/css/normalize.css',
        '/css/owl.carousel.css',
        '/css/main.css',
        '/css/mainAside.css',
        '/css/header.css',
        '/css/content.css',
    ];

    public $js = [
        '/js/jquery-2.2.0.min.js',
        '/js/owl.carousel.min.js',
        '/js/jquery.dotdotdot.min.js',
        '/js/main.js'
    ];
    public $jsOptions = [
        'position'=>\yii\web\View::POS_HEAD,
    ];

    public $depends = [
//        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
    ];
}
