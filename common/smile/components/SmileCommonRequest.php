<?php

/**
 * Created by PhpStorm.
 * User: max
 * Date: 09.02.15
 * Time: 10:23
 */

namespace common\smile\components;

use backend\modules\language\models\Language;
use Yii;
use yii\web\Request;
use yii\helpers\VarDumper;

class SmileCommonRequest extends Request
{
    public function init(){
        parent::init();
        Yii::$app->params['languages'] = Language::find()->with('translate')->asArray()->indexBy('code')->all();
        Yii::$app->params['domain'] = 'smile-cms';
        if($model = Language::findOne(['is_default'=>1])){
            Yii::$app->sourceLanguage = $model->code;
        }else{
            Yii::$app->sourceLanguage = 'ua';
        }
    }
}