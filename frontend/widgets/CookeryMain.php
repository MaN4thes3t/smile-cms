<?php

namespace frontend\widgets;

use backend\modules\newscategory\models\Newscategory;
use backend\modules\news\models\News;
use backend\modules\page\models\Page;
use yii;
use yii\base\Widget;
use yii\helpers\ArrayHelper;

class CookeryMain extends Widget {

    public $news;

    public function init()
    {
        $this->news = News::find()
            ->joinWith(['t', 'images', 'types'])
            ->andWhere([
                '`news`.`show`' => 1,
                '`type_code`' => 'cookery',
            ])
            ->andWhere('`news_translate`.`title` != ""')
            ->andWhere('`create_date` < '.time())
            ->andWhere('`end_date` > '.time())
            ->distinct()
            ->orderBy('create_date DESC')
            ->asArray()
            ->all();
    }

    public function run()
    {
        return $this->render('cookeryMain', [
            'news'=>$this->news,
        ]);
    }
}