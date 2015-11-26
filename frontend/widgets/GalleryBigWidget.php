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

class GalleryBigWidget extends Widget {
    public $page;
    public $pages;
    private $pages_gallery;
    public function init()
    {
        if($this->page->type == Page::TYPE_GALLERY){
            $p = $this->page->parents(1)->one();
            $this->pages_gallery = $p->children(1)->with(['t'])->andWhere(['show'=>'1','type'=>Page::TYPE_GALLERY])->all();
            foreach($this->pages_gallery as $key_g=>$gallery){
                $url = '/';
                $pages = $gallery->parents()->andWhere('depth>0')->all();
                if($pages){
                    foreach($pages as $page){
                        if($page->id != $gallery->id){
                            $url .= $page->translit.'/';
                        }
                    }
                }
                $url .=$gallery->translit;
                $this->pages_gallery[$key_g]->translit = $url;
            }
        }
    }

    public function run()
    {
        return $this->render('galleryBigWidget', [
            'page'=>$this->page,
            'pages_gallery'=>$this->pages_gallery,
        ]);
    }
}