<?php

namespace frontend\widgets;

use backend\modules\news\models\News;
use backend\modules\page\models\Page;
use yii;
use yii\base\Widget;
use yii\helpers\ArrayHelper;

class TheVoiceOfCommunityMain extends Widget {

    public $news;

    public function init()
    {
        $this->news = News::find()
            ->joinWith(['t', 'images', 'types'])
            ->andWhere([
                '`news`.`show`' => 1,
                '`type_code`' => 'the_word_public',
            ])
            ->andWhere('`create_date` < '.time())
            ->andWhere('`end_date` > '.time())
            ->orderBy('create_date DESC')
            ->distinct()
            ->asArray()
            ->one();
    }

    public function run()
    {
            return $this->render('theVoiceOfCommunityMain', [
            'news'=>$this->news,
        ]);
    }
}