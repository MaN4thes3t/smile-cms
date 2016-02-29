<?php

namespace backend\modules\news\controllers;

use backend\modules\news\models\News;
use backend\smile\modules\dropzone\models\SmileDropZoneModel;
use Yii;
use yii\web\Response;
use yii\web\UploadedFile;
use backend\smile\controllers\SmileBackendController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Inflector;
use backend\modules\news\models\NewsSearch;
use yii\filters\AccessControl;
use yii\helpers\FileHelper;
use yii\helpers\VarDumper;
use yii\widgets\ActiveForm;

/**
 * NewsController implements the CRUD actions for News model.
 */
class NewsController extends SmileBackendController
{
    public function actionIndex()
    {
        $searchModel = new NewsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Creates a new News model.
     * If creation is successful, the browser will be redirected to the 'index' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new News();
        $model->loadDefaultValues();
        $model->attachMultilingual();
        $model->attachImageUpload();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->save(false);
            $photo = UploadedFile::getInstance($model, 'photo');
            if($photo){
                $path = Yii::getAlias('@img_root').DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'NewsPhoto'.DIRECTORY_SEPARATOR.$model->id.DIRECTORY_SEPARATOR;
                if(FileHelper::createDirectory($path,0777)){
                    $fileName = substr(uniqid(md5(rand()), true), 0, 10);
                    $fileName .= '-' . Inflector::slug($photo->baseName);
                    $fileName .= '.' . $photo->extension;
                    $path .= $fileName;
                    if($photo->saveAs($path, true)){
                        $model->photo = $fileName;
                        $model->save(false);
                    }
                }
            }
            if(!Yii::$app->request->post('edit')){
                return $this->redirect(['index']);
            }else{
                return $this->redirect(['update','id'=>$model->id]);
            }
        }
        return $this->render('create', [
            'model' => $model,
            'new_image_hash'=>Yii::$app->request->post('new_image_hash','')
        ]);

    }

    public function actionUpdate($id)
    {

        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if(Yii::$app->request->post('photo_deleted')){
                $model->photo = '';
                unlink(Yii::getAlias('@img_root').Yii::$app->request->post('photo_deleted'));
            }
            $photo = UploadedFile::getInstance($model, 'photo');
            if($photo){
                $dir = Yii::getAlias('@img_root').DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'NewsPhoto'.DIRECTORY_SEPARATOR.$model->id;
                SmileDropZoneModel::delTree($dir);
                $path = $dir.DIRECTORY_SEPARATOR;
                if(FileHelper::createDirectory($path,0777)){

                    $fileName = substr(uniqid(md5(rand()), true), 0, 10);
                    $fileName .= '-' . Inflector::slug($photo->baseName);
                    $fileName .= '.' . $photo->extension;
                    $path .= $fileName;
                    if($photo->saveAs($path, true)){
                        $model->photo = $fileName;
                    }
                }
            }
            $model->save(false);
            if(!Yii::$app->request->post('edit')){
                return $this->redirect(['index']);
            }
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
     * Finds the News model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return News the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = News::findOne($id)) !== null) {
            $model->attachMultilingual();
            $model->attachImageUpload();
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
