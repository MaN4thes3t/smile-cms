<?php
/**
 * Created by PhpStorm.
 * User: Kate
 * Date: 19.02.15
 * Time: 12:09
 */
namespace frontend\widgets;

use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use backend\modules\page\models\Page;
use backend\modules\page\models\PageTranslate;
use yii\helpers\VarDumper;

class BreadcrumbsWidget extends Widget {
    public $pages;
    private $main;
    public function init()
    {
        $this->main = Page::find()->with('t')->where(['main_page'=>'1','show'=>'1'])->one();
    }

    public function run()
    {
        return $this->render('breadcrumbsWidget', [
            'pages'=>$this->pages,
            'main'=>$this->main
        ]);
    }
}