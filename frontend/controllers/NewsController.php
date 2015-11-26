<?php
namespace frontend\controllers;
use backend\modules\news\models\News;
use Yii;
use yii\base\InvalidParamException;
use yii\helpers\VarDumper;
use yii\web\BadRequestHttpException;
use app\components\Controller;
use yii\data\Pagination;
/**
 * Site controller
 */
class NewsController extends Controller
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
        $query = News::find()->with('t')->where(['show'=>'1'])->orderBy('date DESC');
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(),'defaultPageSize'=>9]);
        $news = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        $this->view->params['pages'] = 'news';
        return $this->render('index',[
            'news'=>$news,
            'pages'=>$pages
        ]);
    }
    public function actionOne($id){
        VarDumper::dump($id,6,1);
    }

}
