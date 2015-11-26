<?php
namespace frontend\controllers;
use backend\modules\news\models\News;
use backend\modules\pageattach\models\Attachment;
use backend\modules\photo\models\Photo;
use Yii;
use yii\base\InvalidParamException;
use yii\helpers\VarDumper;
use yii\web\BadRequestHttpException;
use app\components\Controller;
use yii\data\Pagination;
/**
 * Site controller
 */
class PhotoController extends Controller
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
        $query = Attachment::find()->where(['entity_id'=>'1','attachment_entity'=>'Photo'])->orderBy('position');
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(),'defaultPageSize'=>16]);
        $photos = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        $this->view->params['pages'] = 'photo';
        return $this->render('index',[
            'photos'=>$photos,
            'pages'=>$pages
        ]);
    }

}
