<?php

namespace backend\modules\leader\models;

use Yii;
use backend\smile\models\SmileBackendModelTranslate;

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
            [['language','description','last_name','first_name','seotitle','seokeywords','seodescription'], 'string'],
            ['seotitle','default','value'=>function($model){
                return $model->first_name.' '.$model->last_name;
            }],
            ['seokeywords','default','value'=>function($model){
                $keywords = [];
                $keywords[] = $model->first_name;
                $keywords[] = $model->last_name;
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
            
        ];
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
