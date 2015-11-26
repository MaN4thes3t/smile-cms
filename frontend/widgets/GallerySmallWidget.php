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

class GallerySmallWidget extends Widget {
    public $page;
    public function init()
    {
    }

    public function run()
    {
        return $this->render('gallerySmallWidget', [
            'page'=>$this->page
        ]);
    }
}