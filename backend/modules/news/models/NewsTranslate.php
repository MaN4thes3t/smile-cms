<?php

namespace backend\modules\news\models;

use backend\smile\modules\dropzone\models\SmileDropZoneModel;
use Yii;
use backend\smile\models\SmileBackendModelTranslate;
use yii\helpers\StringHelper;
use yii\helpers\VarDumper;

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
            [['language'], 'required'],
            [['id_item'], 'required', 'on'=>'ownerUpdate'],
            [['id_item'], 'integer'],
            [['language'], 'string', 'max' => 16],
            [['description'], 'string'],
            [['title'], 'string'],
            [['short_description'], 'string'],
            [['seotitle'], 'string'],
            [['seokeywords'], 'string'],
            ['seotitle','default','value'=>function($model){
                return $model->title;
            }],
            ['seokeywords','default','value'=>function($model){
                $keywords = '';
                $tags = !empty(Yii::$app->request->post()['Tag'])?
                    Yii::$app->request->post()['Tag']:[];
                if($tags){
                    foreach($tags as $tag){
                        $modelTag = new Tag();
                        $modelTag->id_tag = $tag;
                        $keywords .= ', '.$modelTag->tag->t->text;
                    }
                }
                foreach(explode(' ',$model->title) as $title){
                    if($title && is_string($title) && strlen($title)>2){
                        $keywords .= ', '.$title;
                    }
                }
//                $pattern="#[^\d][\s]*([A-ZА-Я][A-zА-я]*)#u";
//                preg_match_all($pattern, $model->description, $match);
//                VarDumper::dump($match,6,1);
//                VarDumper::dump($keywords,6,1);
//                die();
                return mb_substr($keywords,2);
            }],
            ['seodescription','default','value'=>function($model){
                return $model->short_description;
            }],
            [['seodescription'], 'string'],
            [['annotation'], 'string'],
            [['first_name'], 'string'],
            [['second_name'], 'string'],
        ];
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
            'annotation' => Yii::t('backend','Анотация (если тип "Точка зрения")'),
            'first_name' => Yii::t('backend','Имя (если тип "Точка зрения" или "Слово общественности" или "Интервью")'),
            'second_name' => Yii::t('backend','Фамилия (если тип "Точка зрения" или "Слово общественности" или "Интервью")'),
        ];
    }
}
