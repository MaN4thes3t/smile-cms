<?php

namespace frontend\widgets;

use backend\modules\leader\models\Leader;
use backend\modules\news\models\News;
use backend\modules\newscategory\models\Newscategory;
use yii;
use yii\base\Widget;
use yii\helpers\ArrayHelper;

class NewsCategoryMain extends Widget {

    public $news_category;


    public function init()
    {
        $this->news_category = Newscategory::find()
            ->joinWith(['t'])
            ->andWhere([
                '`show`' => 1,
            ])
            ->limit(3)
            ->asArray()
            ->all();
        foreach($this->news_category as $key => $category){
            $this->news_category[$key]['news'] = News::find()
                ->joinWith(['t', 'categories'])
                ->andWhere([
                    '`news`.`show`' => 1,
                    '`category`.`id`' => $category['id']
                ])
                ->andWhere('`create_date` < '.time())
                ->andWhere('`end_date` > '.time())
                ->orderBy('create_date DESC')
                ->indexBy('id')
                ->limit(7)
                ->asArray()
                ->all();
        }
    }
    

    public function run()
    {
        return $this->render('newsCategoryMain', [
            'categories'=>$this->news_category,
        ]);
    }
}