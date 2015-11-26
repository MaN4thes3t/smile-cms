<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class GuestAsset extends AssetBundle
{
    public $basePath = '@webroot';

    public $baseUrl = '@web';

    public $css = [
        'css/layout/guest/styles.css',
    ];

    public $js = [
    ];

    public $depends = [
        /* @var \yii\web\YiiAsset */
        'yii\web\YiiAsset',
        /* @var \yii\bootstrap\BootstrapAsset */
        'yii\bootstrap\BootstrapAsset',
        /* @var \yii\bootstrap\BootstrapPluginAsset */
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
