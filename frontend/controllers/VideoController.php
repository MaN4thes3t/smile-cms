<?php
namespace frontend\controllers;
use backend\modules\news\models\News;
use backend\modules\video\models\Video;
use Yii;
use yii\base\InvalidParamException;
use yii\helpers\VarDumper;
use yii\web\BadRequestHttpException;
use app\components\Controller;
use yii\data\Pagination;
/**
 * Site controller
 */
class VideoController extends Controller
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
        $videos = Video::find()->with('t')->where(['show'=>'1'])->all();
        $this->view->params['pages'] = 'video';
        return $this->render('index',[
            'videos'=>$videos,
        ]);
    }

}
