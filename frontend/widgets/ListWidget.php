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

class ListWidget extends Widget {
    public $pages;
    protected $items;
    public function init()
    {
        $page = current($this->pages);
        $this->items = $page->children()->with(['t','attach'])->andWhere(['type'=>Page::TYPE_LIST])->orderBy('left')->all();
        foreach($this->items as $key=>$item){
            $p = $item->parents()->andWHere('depth>0')->all();
            if($p){
                $url = '';
                foreach($p as $val){
                    $url .= $val->translit.'/';
                }
                $this->items[$key]->translit = $url.$this->items[$key]->translit;
            }

        }
    }

    public function run()
    {
        return $this->render('listWidget', [
            'items'=>$this->items
        ]);
    }
}