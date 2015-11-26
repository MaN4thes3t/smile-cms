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
use yii\helpers\VarDumper;
use backend\modules\page\models\Page;

class MenuWidget extends Widget {
    public $page;

    private $_items;
    public function init()
    {
        $this->_items = Page::find()->with('t')->where(['show_in_menu'=>'1','show'=>'1'])->orderBy('left')->all();
    }

    public function run()
    {
        return $this->render('menuWidget', [
            'page'=>$this->page,
            'items'=>$this->_items
        ]);
    }
}