<?php
/**
 * Created by PhpStorm.
 * User: Kate
 * Date: 09.02.15
 * Time: 12:43
 */
namespace frontend\smile\components;

use Yii;
use common\smile\components\SmileCommonUrlManager;
use yii\helpers\VarDumper;

class SmileFrontendUrlManager extends SmileCommonUrlManager
{
    public function init()
    {
        parent::init();
//        $sessionLanguage = Yii::$app->session->get('language');
//        Yii::$app->language = in_array($sessionLanguage,array_keys(Yii::$app->params['languages']))?$sessionLanguage:Yii::$app->sourceLanguage;
    }

    public function createAbsoluteUrl($params, $scheme=null){
        $domain = '';
        $domain .= Yii::$app->params['domain'];
        $params = (array) $params;
        if(!isset($params['language']) && Yii::$app->language != Yii::$app->sourceLanguage){
            $params['language'] = Yii::$app->language;
        }
        if(isset($params['language'])){
            if($params['language'] != Yii::$app->sourceLanguage){
                $domain .= '/'.$params['language'];
            }
            unset($params['language']);
        }
        if(isset($params[0]) && $params[0] && $params[0][0] != '/'){
            $params[0] = '/'.$params[0];
        }
        $url = 'http'. '://'.$domain.$params[0];
        unset($params[0]);
        $url_params = [];
        try{
            foreach($params as $key => $val){
                $str = '';
                if(is_array($val)){
                    $tmp1 = [];
                    foreach($val as $key1 => $val1){
                        if(is_array($val1)){
                            $tmp2 = [];
                            foreach($val1 as $key2 => $val2){
                                $tmp2[] = $key.'['.$key1.']'.'['.$key2.']'.'='.$val2;
                            }
                            $tmp1[] = implode('&', $tmp2);
                        }
                        else{
                            $tmp1[] = $key.'['.$key1.']'.'='.$val1;
                        }
                    }
                    $str .= implode('&', $tmp1);
                }
                else{
                    $str = $key.'='.$val;
                }
                $url_params[] = $str;
            }
            if(!empty($url_params))
                $url .= '?' . implode('&', $url_params);
        }
        catch(\yii\base\ErrorException $e){

        }
        return urldecode($this->fixPathSlashes($url));
    }

    protected  function fixPathSlashes($url)
    {
        return preg_replace('|\%2F|i', '/', $url);
    }

}