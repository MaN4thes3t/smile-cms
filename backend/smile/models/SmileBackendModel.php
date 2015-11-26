<?php

namespace backend\smile\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\VarDumper;
use backend\smile\components\SmileMultilingualBehavior;

class SmileBackendModel extends ActiveRecord
{

    public $modelPrimaryKeyAttribute = 'id';

    public $multilingualModelClassName;

    public $multilingualKey = 'id_item';

    public $multilingualIndex = 'language';

    public $multilingualArr = [];

//    public function loadDefaultValues($skipIfSet = false)
//    {
//        return parent::loadDefaultValues($skipIfSet);
//    }

    public function getTranslate()
    {
        return $this->hasMany($this->multilingualModelClassName, [$this->multilingualKey => $this->modelPrimaryKeyAttribute])->indexBy($this->multilingualIndex);
    }

    public function getT()
    {
        return $this->hasOne($this->multilingualModelClassName, [$this->multilingualKey => $this->modelPrimaryKeyAttribute])->where([$this->multilingualIndex=>Yii::$app->language]);
    }

    public function attachMultilingual()
    {
        $this->attachBehavior('multilingual', [
            'class' => SmileMultilingualBehavior::className(),
            'multilingualModelClassName'=>$this->multilingualModelClassName,
            'multilingualArr' => $this->multilingualArr,
            'multilingualIndex' => $this->multilingualIndex,
            'multilingualKey' => $this->multilingualKey
        ]);
    }
}
