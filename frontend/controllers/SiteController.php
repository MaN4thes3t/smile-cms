<?php
namespace frontend\controllers;
use backend\modules\news\models\News;
use backend\modules\page\models\Page;
use backend\modules\partners\models\Partners;
use Yii;
use yii\base\InvalidParamException;
use yii\helpers\VarDumper;
use yii\web\BadRequestHttpException;
use app\components\Controller;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [

        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionMainPage(){
        $main_page = Page::find()->with('t')->where(['main_page'=>'1','show'=>'1'])->one();
        if(!$main_page){
            throw new BadRequestHttpException('The requested page does not exist.');
        }
        $news = News::find()->with('t')->where(['show'=>'1'])->orderBy('date DESC')->all();
        $partners = Partners::find()->all();
        return $this->render('main',
            [
                'model'=>$main_page,
                'news'=>$news,
                'partners'=>$partners
            ]);
    }
}
