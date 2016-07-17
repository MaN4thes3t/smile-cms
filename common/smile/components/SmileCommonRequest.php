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
        Yii::$app->params['languages'] = Yii::$app->db->cache(function(){
            return Language::find()->with('translate')->asArray()->indexBy('code')->all();
        }, 3600);
        Yii::$app->params['domain'] = 'smile-cms';
        if($model = Yii::$app->db->cache(function(){ return Language::findOne(['is_default'=>1]);}, 3600)){
            Yii::$app->sourceLanguage = $model->code;
        }else{
            Yii::$app->sourceLanguage = 'ua';
        }
    }
}