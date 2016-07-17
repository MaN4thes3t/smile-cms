<?php

namespace frontend\widgets;

use backend\modules\news\models\News;
use backend\modules\page\models\Page;
use yii;
use yii\base\Widget;
use yii\helpers\ArrayHelper;

class InterviewOne extends Widget {

    public $news;

    public function init()
    {
        $this->news = News::find()
            ->joinWith(['t', 'images', 'types'])
            ->andWhere([
                '`news`.`show`' => 1,
                '`type_code`' => 'interview',
            ])
            ->andWhere('`create_date` < '.time())
            ->andWhere('`end_date` > '.time())
            ->orderBy('create_date DESC')
            ->distinct()
            ->limit(2)
            ->asArray()
            ->all();
    }

    public function run()
    {
        return $this->render('interviewOne', [
            'news'=>$this->news,
        ]);
    }
}