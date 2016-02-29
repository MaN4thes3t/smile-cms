<?php
namespace backend\smile\modules\dropzone\components;

use backend\smile\modules\dropzone\models\SmileDropZoneModel;
use Yii;
use yii\base\Behavior;
use yii\db\ActiveRecord;
use yii\helpers\StringHelper;
use yii\helpers\VarDumper;

class ImageUploadBehavior extends Behavior
{

    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_INSERT => 'afterInsert',
            ActiveRecord::EVENT_AFTER_DELETE => 'afterDelete',
        ];
    }


    public function afterInsert()
    {
        $modelImages = new SmileDropZoneModel();
        $modelImages->initFields($this->owner->id,get_class($this->owner));
        $modelImages->moveImagesNew();
    }

    public function afterDelete()
    {
        $modelImages = new SmileDropZoneModel();
        $modelImages->initFields($this->owner->id,get_class($this->owner));
        $modelImages = $modelImages::find()
            ->where(['id_item'=>$this->owner->id,'model'=>StringHelper::basename(get_class($this->owner))])
            ->all();
        foreach ($modelImages as $model) {
            $model->delete();
        }
    }
}