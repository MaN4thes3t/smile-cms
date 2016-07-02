<?php

namespace frontend\widgets;

use backend\modules\page\models\Page;
use yii;
use yii\base\Widget;
use yii\helpers\ArrayHelper;

class MainNav extends Widget {

    public $pages;

    public $footer = false;

    public function init()
    {
        $this->pages = Page::find()
            ->joinWith(['t'])
            ->andWhere([
                'show' => 1
            ])
            ->andWhere('page_translate.title != ""')
            ->orderBy('order ASC')
            ->asArray()
            ->all();
    }

    public function run()
    {
        return $this->render('mainNav', [
            'pages'=>$this->pages,
            'footer'=>$this->footer,
        ]);
    }
}