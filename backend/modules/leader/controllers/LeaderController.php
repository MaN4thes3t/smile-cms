<?php

namespace backend\modules\leader\controllers;

use backend\modules\leader\models\Leader;
use Yii;

use backend\smile\controllers\SmileBackendController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\modules\leader\models\LeaderSearch;
use yii\filters\AccessControl;

use yii\helpers\VarDumper;

/**
 * LeaderController implements the CRUD actions for Leader model.
 */
class LeaderController extends SmileBackendController
{
//    public function actionUpload($id)
//    {
//        $tour = Tour::findOne($id);
//        if (!$tour) {
//            throw new NotFoundHttpException(Yii::t('app', 'Page not found'));
//        }
//        $picture = new TourPicture(['scenario' => 'upload']);
//        $picture->tour_id = $id;
//        $picture->image = UploadedFile::getInstance($picture, 'image');
//        if ($picture->image !== null && $picture->validate(['image'])) {
//
//            Yii::$app->response->getHeaders()->set('Vary', 'Accept');
//            Yii::$app->response->format = Response::FORMAT_JSON;
//
//            $response = [];
//
//            if ($picture->save(false)) {
//                $response['files'][] = [
//                    'name' => $picture->image->name,
//                    'type' => $picture->image->type,
//                    'size' => $picture->image->size,
//                    'url' => $picture->getImageUrl(),
//                    'thumbnailUrl' => $picture->getImageUrl(TourPicture::SMALL_IMAGE),
//                    'deleteUrl' => Url::to(['delete', 'id' => $picture->id]),
//                    'deleteType' => 'POST'
//                ];
//            } else {
//                $response[] = ['error' => Yii::t('app', 'Unable to save picture')];
//            }
//            @unlink($picture->image->tempName);
//        } else {
//            if ($picture->hasErrors(['picture'])) {
//                $response[] = ['error' => HtmlHelper::errors($picture)];
//            } else {
//                throw new HttpException(500, Yii::t('app', 'Could not upload file.'));
//            }
//        }
//        return $response;
//    }

    public function actionUpload()
    {
        //need rewrite
        $fileName = 'file';
        $uploadPath = Yii::getAlias('@img_root').'/images';

        if (isset($_FILES[$fileName])) {
            $file = \yii\web\UploadedFile::getInstanceByName($fileName);

            if ($file->saveAs($uploadPath . '/' . $file->name)) {
                //Now save file data to database

                echo \yii\helpers\Json::encode($file);
            }
        }

        return false;
    }

    public function actionIndex()
    {
        $searchModel = new LeaderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Creates a new Leader model.
     * If creation is successful, the browser will be redirected to the 'index' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Leader();
        $model->loadDefaultValues();
        $model->attachMultilingual();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->save(false);
            return $this->redirect(['index']);
        }
        return $this->render('create', [
            'model' => $model,
        ]);

    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->save(false);
            return $this->redirect(['index']);
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Leader model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Leader the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Leader::findOne($id)) !== null) {
            $model->attachMultilingual();
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
