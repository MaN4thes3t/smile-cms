<?php
/**
 * Created by PhpStorm.
 * User: Kate
 * Date: 10.02.15
 * Time: 16:12
 */
namespace backend\smile\components;

use Yii;
use yii\base\Behavior;
use yii\db\ActiveRecord;
use yii\helpers\VarDumper;

class SmileMultilingualBehavior extends Behavior
{
    public $multilingualModelClassName;
    public $multilingualKey;
    public $multilingualIndex;
    public $ownerPK;
    public $translatePK;
    public $multilingualArr;
    public $translateModels = array();
    private $_noChecking;

    public function attach($owner)
    {
        parent::attach($owner);
        $this->configure();
        $this->initializeTranslatesModels();
    }

    public function configure()
    {
        $ownerClassName = $this->owner->className();
        $multilingualModelClassName = $this->multilingualModelClassName;

        $this->ownerPK = current($ownerClassName::primaryKey());
        $this->translatePK = current($multilingualModelClassName::primaryKey());

        $this->_noChecking = [
            $this->multilingualIndex,
            $this->multilingualKey,
            $this->translatePK,
        ];
    }

    public function initializeTranslatesModels()
    {
        if(!$this->owner->isNewRecord){
            $this->translateModels = array_merge($this->translateModels, $this->owner->translate);
        }
        foreach(Yii::$app->params['languages'] as $lang=>$info)
        {
            if ($this->owner->isNewRecord || !isset($this->translateModels[$lang])) {
                $this->translateModels[$lang] = new $this->multilingualModelClassName();
            }
        }
    }

    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_UPDATE => 'afterUpdate',
            ActiveRecord::EVENT_AFTER_INSERT => 'afterInsert',
            ActiveRecord::EVENT_AFTER_DELETE => 'afterDelete',
            ActiveRecord::EVENT_BEFORE_VALIDATE => 'beforeValidate',
        ];
    }

    public function beforeValidate($event)
    {
        $isValid = true;

        $className = $this->prepareClassName($this->multilingualModelClassName);
        foreach(Yii::$app->params['languages'] as $lang=>$info)
        {
            if($this->multilingualArr){
                $this->translateModels[$lang]->load([$className => $this->multilingualArr[$className][$lang]]);
            }else{
                $this->translateModels[$lang]->load([$className => Yii::$app->request->post()[$className][$lang]]);
            }
            $this->translateModels[$lang]->{$this->multilingualIndex} = $lang;
            $makeValidate = false;
            foreach($this->translateModels[$lang]->attributes as $key=>$val) {
                if(in_array($key, $this->_noChecking))
                {
                    continue;
                }
                if(!empty($val))
                {
                    $makeValidate = true;
                }
            }
            if($makeValidate){
                $result = $this->translateModels[$lang]->validate();
                if(!$result){
                    $isValid = false;
                }
            }
        }
        return $event->isValid = $isValid;
    }

    public function afterInsert()
    {
        $this->_saveTranslations();
    }

    public function afterUpdate()
    {
        $this->_saveTranslations();
    }

    public function afterDelete()
    {
        foreach($this->translateModels as $model)
            $model->delete();
    }

    private function _saveTranslations()
    {
        foreach($this->translateModels as &$model)
        {
            $model->{$this->multilingualKey} = $this->owner->{$this->ownerPK};
            $model->save(false);
        }
        return true;
    }

    private function prepareClassName($name)
    {
        return @end(explode('\\', $name));
    }
}