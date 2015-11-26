<?php
namespace backend\controllers;

use Yii;
use yii\helpers\VarDumper;
use backend\smile\controllers\SmileBackendController;
use backend\models\LoginForm;


/**
 * Site controller
 */
class SiteController extends SmileBackendController
{
    /**
     * @inheritdoc
     */

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        $this->layout = 'guest';
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    public function actionChangeLanguage(){
//
        if(Yii::$app->request->isAjax){
            if($language = Yii::$app->request->post('language','')){
                Yii::$app->session->set('language',$language);
            }
        }
    }
}
