<?php

namespace frontend\widgets;

use backend\modules\news\models\News;
use backend\modules\page\models\Page;
use yii;
use yii\base\Widget;
use yii\helpers\ArrayHelper;

class ZhitomirLiveAside extends Widget {

    public $news;

    public function init()
    {
        $this->news = News::find()
            ->joinWith(['t', 'images', 'types'])
            ->andWhere([
                '`news`.`show`' => 1,
                '`type_code`' => 'zhitomir_live',
            ])
            ->andWhere('`create_date` < '.time())
            ->andWhere('`end_date` > '.time())
            ->distinct()
            ->orderBy('create_date DESC')
            ->asArray()
            ->limit(3)
            ->all();
    }

    public function run()
    {
        return $this->render('zhitomirLiveAside', [
            'news'=>$this->news,
        ]);
    }
}