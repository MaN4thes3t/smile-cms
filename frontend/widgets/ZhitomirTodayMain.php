<?php

namespace frontend\widgets;

use backend\modules\newscategory\models\Newscategory;
use backend\modules\news\models\News;
use backend\modules\page\models\Page;
use yii;
use yii\base\Widget;
use yii\helpers\ArrayHelper;

class ZhitomirTodayMain extends Widget {

    public $news;

    public $category;

    public $pages;

    public function init()
    {
        $query = News::find()
            ->joinWith(['t', 'images', 'categories', 'source'])
            ->andWhere([
                '`news`.`show`' => 1,
                'id_category' => 9,
            ])
            ->andWhere('`news_translate`.`title` != ""')
            ->andWhere('`create_date` < '.time())
            ->andWhere('`end_date` > '.time())
            ->distinct()
            ->orderBy('create_date DESC')
            ->asArray();

        $countQuery = clone $query;
        $this->category = Newscategory::findOne(9);
        $this->pages = new yii\data\Pagination([
            'totalCount' => $countQuery->count(),
            'route' => $this->category->translit,
            'defaultPageSize' => 15
        ]);
        $this->news = $query
            ->offset($this->pages->offset)
            ->limit($this->pages->limit)
            ->all();

    }

    public function run()
    {
        return $this->render('zhitomirTodayMain', [
            'news'=>$this->news,
            'category'=>$this->category,
            'pages' => $this->pages,
        ]);
    }
}