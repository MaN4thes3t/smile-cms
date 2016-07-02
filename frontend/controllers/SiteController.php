<?php
namespace frontend\controllers;

use yii;
use frontend\smile\controllers\SmileFrontendController;

class SiteController extends SmileFrontendController
{

    public function actionIndex(){
        return $this->render('index');
    }

}
