<?php

namespace backend\modules\page\controllers;

use backend\modules\page\models\Page;
use Yii;

use backend\smile\controllers\SmileBackendController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\modules\page\models\PageSearch;
use yii\filters\AccessControl;

use yii\helpers\VarDumper;

/**
 * PageController implements the CRUD actions for Page model.
 */
class PageController extends SmileBackendController
{

    public function actionIndex()
    {
        $searchModel = new PageSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Creates a new Page model.
     * If creation is successful, the browser will be redirected to the 'index' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Page();
        $model->loadDefaultValues();
        $model->attachMultilingual();
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
     * Finds the Page model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Page the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Page::findOne($id)) !== null) {
            $model->attachMultilingual();
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
