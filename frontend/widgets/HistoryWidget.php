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
use backend\modules\history\models\History;

class HistoryWidget extends Widget {
    public $page;
    protected $items;
    public function init()
    {
        $this->items = History::find()->where(['show'=>'1','page_id'=>$this->page->id])->orderBy('date')->all();
//        VarDumper::dump($this->items,6,1);
    }

    public function run()
    {
        return $this->render('historyWidget', [
            'items'=>$this->items
        ]);
    }
}