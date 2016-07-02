<?php

namespace frontend\smile\components;

use backend\modules\language\models\Language;
use yii;
use common\smile\components\SmileCommonRequest;
use yii\helpers\VarDumper;

class SmileFrontendRequest extends SmileCommonRequest
{

    public $frontendWebUrl;
    
    public function getBaseUrl()
    {
        return str_replace($this->frontendWebUrl, "", parent::getBaseUrl());
    }
    
    public function init()
    {
        parent::init();
        Yii::$app->language = Yii::$app->sourceLanguage;
        $url = $this->getUrl();
        $matches = array();
        preg_match('/^\/([a-z]{2})/', $url, $matches);
//        echo '<pre>';
//        var_dump($url);
//        var_dump($matches);
//        echo '</pre>';
//        die();
        if(is_array($matches)
            && !empty($matches)
            && !empty($matches[1])
            && in_array($matches[1], array_keys(Yii::$app->params['languages'])))
        {
            Yii::$app->language = $matches[1];
            $this->setUrl(str_replace($matches[0], '/', $url));
//            echo '<pre>';
//            var_dump(Yii::$app->language);
//            var_dump($url);
//            var_dump($this->getUrl());
//            var_dump($matches);
//            var_dump(in_array($matches[1], array_keys(Yii::$app->params['languages'])));
//            echo '</pre>';
//            die();
        }
    }
}