<?php

namespace backend\modules\leader\models;

use Yii;

use backend\smile\models\SmileBackendModel;
use backend\smile\modules\dropzone\models\SmileDropZoneModel;

use yii\helpers\StringHelper;
use yii\helpers\VarDumper;
/**
 * This is the model class for table "leader".
 *
 * @property integer $id
 * @property integer $show
 * @property integer $birthday
 *
 */
class Leader extends SmileBackendModel
{

    /**
     * @inheritdoc
     */
    public function init(){
        $this->multilingualModelClassName = LeaderTranslate::className();
        parent::init();
    }

    public static function tableName()
    {
        return 'leader';
    }

    /**
     * @inheritdoc
     */

    public function rules()
    {
        return [
            [['show'], 'required'],
            [['birthday'], 'string'],
            [['birthday'], 'birthdayValidation']
        ];
    }
    public function birthdayValidation($attribute, $params){
        if ($this->$attribute) {
            if(is_string($this->$attribute)){
                $this->$attribute = strtotime($this->$attribute);

            }else{
                $this->addError($attribute, Yii::t('backend','Введите корректную дату'));
            }
        }

    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend','Ид'),
            'show' => Yii::t('backend','Отображать'),
            'birthday' => Yii::t('backend','День рождения'),
        ];
    }

    public function afterDelete(){
        $modelImages = new SmileDropZoneModel();
        $modelImages->initFields($this->id,get_class($this));
        $modelImages = $modelImages::find()
            ->where(['id_item'=>$this->id,'model'=>StringHelper::basename(get_class($this))])
            ->all();
        foreach ($modelImages as $model) {
            $model->delete();
        }
        parent::afterDelete();
    }

}
