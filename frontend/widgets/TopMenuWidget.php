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

class TopMenuWidget extends Widget {
    public $pages;
    protected $items;
    public function init()
    {
        $items = Page::find()
            ->where(['depth'=>1,'show_in_menu'=>'1','show'=>'1'])
            ->with('t')
            ->orderBy('left')
            ->all();
        $this->items = $items;
    }

    public function run()
    {
        return $this->render('topMenuWidget', [
            'items'=>$this->items,
            'pages'=>$this->pages
        ]);
    }
}