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
        $model->attachImageUpload();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->save(false);
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
            $model->attachImageUpload();
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
