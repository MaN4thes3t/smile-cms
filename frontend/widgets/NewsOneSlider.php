<?php

namespace frontend\widgets;

use backend\modules\news\models\News;
use backend\modules\page\models\Page;
use yii;
use yii\base\Widget;
use yii\helpers\ArrayHelper;

class NewsOneSlider extends Widget {

    public $news;

    public function init()
    {
        $this->news = News::find()
            ->joinWith(['t', 'images', 'types'])
            ->andWhere([
                '`news`.`show`' => 1,
                '`type_code`' => 'news_one',
            ])
            ->andWhere('`create_date` < '.time())
            ->andWhere('`end_date` > '.time())
            ->limit(5)
            ->distinct()
            ->orderBy('create_date DESC')
            ->asArray()
            ->all();
    }

    public function run()
    {
        return $this->render('newsOneSlider', [
            'news'=>$this->news,
        ]);
    }
}