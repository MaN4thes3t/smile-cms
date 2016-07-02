<?php

namespace frontend\widgets;

use backend\modules\news\models\News;
use yii;
use yii\base\Widget;
use yii\helpers\ArrayHelper;

class FamousPeopleHeader extends Widget {

    public $news;

    public function init()
    {
        $this->news = News::find()
            ->joinWith(['t', 'types'])
            ->andWhere([
                '`news`.`show`' => 1,
                'type_code' => 'point_of_view',
            ])
            ->andWhere('`news_translate`.`title` != ""')
            ->andWhere('`create_date` < '.time())
            ->andWhere('`end_date` > '.time())
            ->limit(4)
            ->distinct()
            ->orderBy('create_date DESC')
            ->asArray()
            ->all();
    }

    public function run()
    {
        return $this->render('famousPeopleHeader', [
            'news'=>$this->news
        ]);
    }
}