<?php

namespace backend\modules\leader\models;

use Yii;

use backend\smile\models\SmileBackendModel;
use backend\modules\leader\models\LeaderImage;
use backend\smile\modules\dropzone\models\SmileDropZoneModel;

use yii\helpers\StringHelper;
use yii\helpers\VarDumper;use dosamigos\transliterator\TransliteratorHelper;
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
            [['birthday'], 'birthdayValidation'],
            [['translit'],'translitValidation','skipOnEmpty' => false],
        ];
    }

    public function getImages()
    {
        return $this->hasMany(LeaderImage::className(), [$this->multilingualKey => $this->modelPrimaryKeyAttribute])->orderBy('order')->indexBy('id');
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
    public function translitValidation($attribute,$params){
        $this->$attribute = trim($this->$attribute);
        if(empty($this->$attribute)){
            foreach(Yii::$app->params['languages'] as $lang=>$info){
                if($this->$attribute){
                    break;
                }
                $this->$attribute = $this->translateModels[$lang]->first_name.'-'.$this->translateModels[$lang]->last_name;
            }
        }
        $this->$attribute = mb_strtolower(str_replace(' ','-',$this->$attribute));
        $this->$attribute = TransliteratorHelper::process($this->$attribute,'-','en');
        $duplicates = self::find()->where([$attribute=>$this->$attribute])->all();
        if(count($duplicates)){
            $this->$attribute .= '-'.$this->id;
        }
    }
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend','Ид'),
            'show' => Yii::t('backend','Отображать'),
            'birthday' => Yii::t('backend','День рождения'),
            'translit' => Yii::t('backend','Транслит'),
        ];
    }

    public function afterDelete(){
        parent::afterDelete();
    }

}
