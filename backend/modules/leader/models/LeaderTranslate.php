<?php

namespace backend\modules\leader\models;

use Yii;
use backend\smile\models\SmileBackendModelTranslate;
use dosamigos\transliterator\TransliteratorHelper;
/**
 * This is the model class for table "leader_translate".
 *
 * @property integer $id
 * @property string $language
 * @property integer $id_item
 * @property string $description
 * @property string $first_name
 * @property string $last_name
 * @property string $seotitle
 * @property string $seokeywords
 * @property string $seodescription
 * @property string $translit
 *
 */
class LeaderTranslate extends SmileBackendModelTranslate
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'leader_translate';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['language','description','last_name','first_name'], 'required'],
            [['id_item'], 'required', 'on'=>'ownerUpdate'],
            [['id_item'], 'integer'],
            [['language'], 'string', 'max' => 16],
            [['description'], 'string'],
            [['last_name'], 'string'],
            [['first_name'], 'string'],
            [['seotitle'], 'string'],
            [['seokeywords'], 'string'],
            [['seodescription'], 'string'],
            [['translit'],'translitValidation','skipOnEmpty' => false],
        ];
    }
    public function translitValidation($attribute,$params){
        $this->$attribute = trim($this->$attribute);
        if(empty($this->$attribute)){
            $this->$attribute = $this->first_name.$this->last_name;
        }
        $this->$attribute = str_replace(' ','-',$this->$attribute);
        $this->$attribute = TransliteratorHelper::process($this->$attribute,'-','en');
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'first_name' => Yii::t('backend','Имя'),
            'last_name' => Yii::t('backend','Фамилия'),
            'seotitle' => Yii::t('backend','SEO-title'),
            'translit' => Yii::t('backend','Транслит лидера'),
            'seokeywords' => Yii::t('backend','SEO-keywords'),
            'seodescription' => Yii::t('backend','SEO-description'),
            'description' => Yii::t('backend','Описание'),
        ];
    }
}
