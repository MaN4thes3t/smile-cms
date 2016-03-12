<?php

namespace backend\modules\advice\models;

use Yii;
use backend\smile\models\SmileBackendModelTranslate;
use dosamigos\transliterator\TransliteratorHelper;
/**
 * This is the model class for table "advice_translate".
 *
 * @property integer $id
 * @property string $language
 * @property integer $id_item
 * @property string $description
 * @property string $title
 * @property string $seotitle
 * @property string $seokeywords
 * @property string $seodescription
 * @property string $translit
 *
 */
class AdviceTranslate extends SmileBackendModelTranslate
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'advice_translate';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['language','title','short_description','description'], 'required'],
            [['id_item'], 'required', 'on'=>'ownerUpdate'],
            [['id_item'], 'integer'],
            [['translit'],'translitValidation','skipOnEmpty' => false],
            [['language'], 'string', 'max' => 16],
            [['description'], 'string'],
            [['title'], 'string'],
            [['seotitle'], 'string'],
            [['seokeywords'], 'string'],
            [['seodescription'], 'string'],
            [['short_description'], 'string'],
        ];
    }

    public function translitValidation($attribute,$params){
        $this->$attribute = trim($this->$attribute);
        if(empty($this->$attribute)){
            $this->$attribute = $this->title;
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
            'title' => Yii::t('backend','Заголовок'),
            'seotitle' => Yii::t('backend','SEO-title'),
            'seokeywords' => Yii::t('backend','SEO-keywords'),
            'translit' => Yii::t('backend','Транслит совета'),
            'seodescription' => Yii::t('backend','SEO-description'),
            'description' => Yii::t('backend','Описание'),
            'short_description' => Yii::t('backend','Короткое описание'),
        ];
    }
}
