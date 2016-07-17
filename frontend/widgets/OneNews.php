<?php

namespace frontend\widgets;

use backend\modules\news\models\News;
use backend\modules\page\models\Page;
use yii;
use yii\base\Widget;
use yii\helpers\ArrayHelper;

class OneNews extends Widget {

    public $news;

    public function run()
    {
        return $this->render('oneNews', [
            'news'=>$this->news,
        ]);
    }
}