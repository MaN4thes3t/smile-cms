<?php
namespace frontend\controllers;

use Yii;
use frontend\smile\controllers\SmileFrontendController;

/**
 * Site controller
 */
class SiteController extends SmileFrontendController
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

    public function actionIndex(){
        echo 'site, action index';
        return $this->render('index');
    }

}
