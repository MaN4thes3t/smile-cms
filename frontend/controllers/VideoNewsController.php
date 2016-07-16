<?php
namespace frontend\controllers;

use backend\modules\news\models\News;
use yii;
use frontend\smile\controllers\SmileFrontendController;

class VideoNewsController extends SmileFrontendController
{
    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config = []);
        $this->id = 'news';
    }

    public function actionIndex(){
        die('333');
    }

    public function actionOne($url){
        $news = News::find()
            ->joinWith(['t', 'images', 'tags'])
            ->andWhere([
                'translit' => $url,
                '`news`.`show`' => 1,
            ])
            ->andWhere('`create_date` < '.time())
            ->andWhere('`news_translate`.`title` != ""')
            ->andWhere('`end_date` > '.time())
            ->orderBy('create_date DESC')
            ->asArray()
            ->one();
        if(!$news){
            throw new yii\web\HttpException(404);
        }
        return $this->render('index', [
           'news' => $news
        ]);
    }

}
