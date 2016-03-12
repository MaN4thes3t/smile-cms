<?php

namespace backend\modules\page\models;

use Yii;
use backend\smile\models\SmileBackendModelTranslate;
use dosamigos\transliterator\TransliteratorHelper;
/**
 * This is the model class for table "page_translate".
 *
 * @property integer $id
 * @property string $language
 * @property integer $id_item
 * @property string $description
 * @property string $title
 * @property string $seotitle
 * @property string $seokeywords
 * @property string $seodescription
 *
 */
class PageTranslate extends SmileBackendModelTranslate
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'page_translate';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['language','description'], 'required'],
            [['id_item'], 'required', 'on'=>'ownerUpdate'],
            [['id_item'], 'integer'],
            [['language','description','title','seotitle','seokeywords','seodescription'], 'string'],
            ['seotitle','default','value'=>function($model){
                return $model->title;
            }],
            ['seokeywords','default','value'=>function($model){
                $keywords = [];
                foreach(explode(' ',$model->title) as $title){
                    if($title && is_string($title) && strlen($title)>2){
                        $keywords[] = $title;
                    }
                }
                $description = explode(' ', trim(str_replace([
                    ' .',
                    ' ,',
                    ' :',
                    ' ;',
                    ' !',
                    ' ?',
                ],[
                    '.',
                    ',',
                    ':',
                    ';',
                    '!',
                    '?',
                ],preg_replace('| +|', ' ', preg_replace("(<[^<>]+>)", ' ', $model->description)))));
                foreach($description as $key=>$word){
                    $word = (string)$word;
                    $chr = mb_substr($word, 0, 1, 'UTF-8');
                    if(mb_strlen($word,'UTF-8') >= 3 //если длина 3 и больше символа
                        && mb_strtolower($chr, 'UTF-8') != $chr //если слово с большой буквы
                        && isset($description[$key-1]) //если это не начало текста
                        && !in_array(substr($description[$key-1],-1),['.','!','?']) //если это не начало предложения
                    ){
                        $keywords[] = str_replace([
                            '.',
                            ',',
                            ':',
                            ';',
                            '!',
                            '?',
                        ],'',$word);
                    }
                }
                return implode(', ', $keywords);
            }],
            [['translit'],'translitValidation','skipOnEmpty' => false],
        ];
    }
    public function translitValidation($attribute,$params){
        $this->$attribute = trim($this->$attribute);
        if(empty($this->$attribute)){
            $this->$attribute = $this->title;
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
            'title' => Yii::t('backend','Заголовок'),
            'seotitle' => Yii::t('backend','SEO-title'),
            'seokeywords' => Yii::t('backend','SEO-keywords'),
            'seodescription' => Yii::t('backend','SEO-description'),
            'description' => Yii::t('backend','Описание'),
            'translit' => Yii::t('backend','Транслит страницы'),
        ];
    }
}
