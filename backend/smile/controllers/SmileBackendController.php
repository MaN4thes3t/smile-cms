<?php
/**
 * Created by PhpStorm.
 * User: Kate
 * Date: 09.02.15
 * Time: 14:13
 */

namespace backend\smile\controllers;
use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\helpers\VarDumper;

class SmileBackendController extends Controller {

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
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'], // @ - auth users
                    ],
                    [
                        'allow' => true,
                        'actions' => ['login'], // ? - guest users
                        'roles' => ['?'],
                    ],
                ],
            ],
        ];
    }
}