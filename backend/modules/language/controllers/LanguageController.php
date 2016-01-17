<?php

namespace backend\modules\language\controllers;

use backend\modules\language\models\Language;
use Yii;

use backend\smile\controllers\SmileBackendController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\modules\language\models\LanguageSearch;
use yii\filters\AccessControl;

use yii\helpers\VarDumper;

/**
 * LanguageController implements the CRUD actions for Language model.
 */
class LanguageController extends SmileBackendController
{

    public function actionIndex()
    {
        $searchModel = new LanguageSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Creates a new Language model.
     * If creation is successful, the browser will be redirected to the 'index' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Language();
        $model->loadDefaultValues();
        $model->attachMultilingual();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if($model->is_default){
                Language::updateAll(['is_default'=>0],['is_default'=>1]);
            }
            $model->save(false);
            if(!Yii::$app->request->post('edit')){
                return $this->redirect(['index']);
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);

    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if($model->is_default){
                Language::updateAll(['is_default'=>0],['is_default'=>1]);
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
     * Finds the Language model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Language the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Language::findOne($id)) !== null) {
            $model->attachMultilingual();
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
