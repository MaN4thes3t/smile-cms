<?php
namespace frontend\controllers;
use backend\modules\news\models\News;
use backend\modules\partners\models\Partners;
use Yii;
use yii\base\InvalidParamException;
use yii\helpers\VarDumper;
use yii\web\BadRequestHttpException;
use app\components\Controller;
use yii\data\Pagination;
/**
 * Site controller
 */
class PartnersController extends Controller
{
    public $defaultAction = 'index';
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
        $partners = Partners::find()->where(['show'=>'1'])->all();
        $this->view->params['pages'] = 'partners';
        return $this->render('index',[
            'partners'=>$partners,
        ]);
    }

}
