<?php

namespace backend\modules\news\models;

use backend\smile\modules\dropzone\models\SmileDropZoneModel;
use Yii;
use backend\smile\models\SmileBackendModelTranslate;
use yii\helpers\StringHelper;
use yii\helpers\VarDumper;
use dosamigos\transliterator\TransliteratorHelper;


/**
 * This is the model class for table "news_translate".
 *
 * @property integer $id
 * @property string $language
 * @property integer $id_item
 * @property string $description
 * @property string $short_description
 * @property string $title
 * @property string $last_name
 * @property string $seotitle
 * @property string $seokeywords
 * @property string $seodescription
 * @property string $translit
 *
 */
class NewsTranslate extends SmileBackendModelTranslate
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news_translate';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['language','title','description','short_description'], 'required'],
            [['id_item'], 'required', 'on'=>'ownerUpdate'],
            [['id_item'], 'integer'],
            [['language','description','title','short_description','seotitle',
            'seokeywords','annotation','first_name','second_name',
            'seodescription'], 'string'],
            [['translit'],'translitValidation','skipOnEmpty' => false],
            ['seotitle','default','value'=>function($model){
                return $model->title;
            }],
            ['seokeywords','default','value'=>function($model){
                $keywords = [];
                $tags = !empty(Yii::$app->request->post()['Tag'])?
                    Yii::$app->request->post()['Tag']:[];
                if($tags){
                    foreach($tags as $tag){
                        $modelTag = new Tag();
                        $modelTag->id_tag = $tag;
                        $keywords[] = $modelTag->tag->t->text;
                    }
                }
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
            ['seodescription','default','value'=>function($model){
                return $model->short_description;
            }],
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
            'short_description' => Yii::t('backend','Короткое описание'),
            'seotitle' => Yii::t('backend','SEO-title'),
            'seokeywords' => Yii::t('backend','SEO-keywords'),
            'seodescription' => Yii::t('backend','SEO-description'),
            'description' => Yii::t('backend','Описание'),
            'translit' => Yii::t('backend','Транслит новости'),
            'annotation' => Yii::t('backend','Анотация (если тип "Точка зрения")'),
            'first_name' => Yii::t('backend','Имя (если тип "Точка зрения" или "Слово общественности" или "Интервью")'),
            'second_name' => Yii::t('backend','Фамилия (если тип "Точка зрения" или "Слово общественности" или "Интервью")'),
        ];
    }
}
