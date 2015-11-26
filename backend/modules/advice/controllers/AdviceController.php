<?php

namespace backend\modules\advice\controllers;

use backend\modules\advice\models\Advice;
use Yii;

use backend\smile\controllers\SmileBackendController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\modules\advice\models\AdviceSearch;
use yii\filters\AccessControl;

use yii\helpers\VarDumper;

/**
 * AdviceController implements the CRUD actions for Advice model.
 */
class AdviceController extends SmileBackendController
{
    public function actionIndex()
    {
        $searchModel = new AdviceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Creates a new Advice model.
     * If creation is successful, the browser will be redirected to the 'index' advice.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Advice();
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
     * Finds the Advice model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Advice the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Advice::findOne($id)) !== null) {
            $model->attachMultilingual();
            return $model;
        } else {
            throw new NotFoundHttpException('The requested advice does not exist.');
        }
    }
}
