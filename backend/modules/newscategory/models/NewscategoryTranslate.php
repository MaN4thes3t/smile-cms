<?php

namespace backend\modules\newscategory\models;

use Yii;
use backend\smile\models\SmileBackendModelTranslate;
use dosamigos\transliterator\TransliteratorHelper;
/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property string $language
 * @property integer $id_item
 * @property string $name
 * @property string $translit
 *
 */
class NewscategoryTranslate extends SmileBackendModelTranslate
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category_translate';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['language','name'], 'required'],
            [['id_item'], 'required', 'on'=>'ownerUpdate'],
            [['id_item'], 'integer'],
            [['language'], 'string', 'max' => 16],
            [['name'], 'string'],
            [['translit'],'translitValidation','skipOnEmpty' => false],
        ];
    }
    public function translitValidation($attribute,$params){
        $this->$attribute = trim($this->$attribute);
        if(empty($this->$attribute)){
            $this->$attribute = $this->name;
        }
        $this->$attribute = strtolower(str_replace(' ','-',$this->$attribute));
        $this->$attribute = TransliteratorHelper::process($this->$attribute,'-','en');
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('backend','Название'),
            'translit' => Yii::t('backend','Транслит категории'),
        ];
    }
}
