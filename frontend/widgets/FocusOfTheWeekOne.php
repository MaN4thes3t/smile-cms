<?php

namespace frontend\widgets;

use backend\modules\news\models\News;
use backend\modules\page\models\Page;
use yii;
use yii\base\Widget;
use yii\helpers\ArrayHelper;

class FocusOfTheWeekOne extends Widget {

    public $news;

    public function init()
    {
        $this->news = News::find()
            ->joinWith(['t', 'images', 'types'])
            ->andWhere([
                '`news`.`show`' => 1,
                '`type_code`' => 'focus_of_the_week',
            ])
            ->andWhere('`create_date` < '.time())
            ->andWhere('`end_date` > '.time())
            ->orderBy('create_date DESC')
            ->distinct()
            ->limit(5)
            ->asArray()
            ->all();
    }

    public function run()
    {
        return $this->render('focusOfTheWeekOne', [
            'news'=>$this->news,
        ]);
    }
}