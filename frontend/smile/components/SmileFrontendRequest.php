<?php

/**
 * Created by PhpStorm.
 * User: max
 * Date: 09.02.15
 * Time: 10:23
 */

namespace frontend\smile\components;

use backend\modules\language\models\Language;
use Yii;
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
        preg_match('/^\/([a-z]{2})\//', $url, $matches);
        if(is_array($matches)
            && !empty($matches)
            && !empty($matches[1])
            && in_array($matches[1],array_keys(Yii::$app->params['languages'])))
        {
            Yii::$app->language = $matches[1];
            $this->setUrl(str_replace($matches[0], '/', $url));
        }
    }
}