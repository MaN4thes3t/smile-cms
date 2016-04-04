<?php
namespace frontend\controllers;

use Yii;
use frontend\smile\controllers\SmileFrontendController;

/**
 * Site controller
 */
class NewsController extends SmileFrontendController
{
    static $TYPES = [
        'one-news'=>'one-news',
    ];

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

    public function actionOneNews(){
        echo 'news, actionOneNews';
    }

    public function actionIndex($url){
        echo 'news, action index '.$url;
        if(in_array($url,self::$TYPES)){
            $this->runAction(self::$TYPES[$url]);
        }
        return $this->render('index');
    }

    public function actionList(){
        echo 'news, action list';
        return $this->render('list');
    }


}
