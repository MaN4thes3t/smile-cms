<?php

/**
 * Created by PhpStorm.
 * User: max
 * Date: 09.02.15
 * Time: 10:23
 */

namespace backend\smile\components;

use Yii;
use common\smile\components\SmileCommonRequest;
use yii\helpers\VarDumper;

class SmileBackendRequest extends SmileCommonRequest
{
    public $backendWebUrl;
    public $backendUrl;


    public function getBaseUrl()
    {
        return str_replace($this->backendWebUrl, "", parent::getBaseUrl()) . $this->backendUrl;
    }

    public function init()
    {
        parent::init();
        $sessionLanguage = Yii::$app->session->get('language');
        Yii::$app->language = in_array($sessionLanguage,array_keys(Yii::$app->params['languages']))?$sessionLanguage:Yii::$app->sourceLanguage;
    }


    public function resolvePathInfo()
    {
        if ($this->getUrl() === $this->backendUrl) {
            return "";
        } else {
            return parent::resolvePathInfo();
        }
    }
}