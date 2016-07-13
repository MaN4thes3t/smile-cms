<?php

namespace backend\modules\news\models;

use backend\modules\news\models\NewsImage;
use yii;

use backend\smile\models\SmileBackendModel;
use backend\smile\modules\dropzone\models\SmileDropZoneModel;
use yii\helpers\StringHelper;
use yii\helpers\VarDumper;
use dosamigos\transliterator\TransliteratorHelper;
/**
 * This is the model class for table "news".
 *
 * @property integer $id
 * @property integer $show
 * @property integer $create_date
 * @property integer $end_date
 * @property integer $photo
 * @property integer $event_date
 * @property integer $color
 * @property integer $title_color
 * @property integer $views
 * @property integer $user_id
 * @property integer $comments
 *
 */
class News extends SmileBackendModel
{

    /**
     * @inheritdoc
     */
    public function init(){
        $this->multilingualModelClassName = NewsTranslate::className();
        parent::init();
    }

    public static function tableName()
    {
        return 'news';
    }

    /**
     * @inheritdoc
     */

    public function rules()
    {
        return [
            [['show'], 'required'],
            [['create_date','end_date','color','event_date','title_color'], 'string'],
            [['photo'], 'file', 'extensions' => 'gif, jpg, png'],
            ['create_date','default','value'=>function($value){
                return date('m/d/Y H:i');
            }],
            ['end_date','default','value'=>function($value){
                return date('m/d/Y',strtotime('+1 year'));
            }],
            [['create_date','end_date','event_date'], 'dateValidation'],
            [['user_id','views','comments'],'integer'],
            ['user_id','default','value'=>function($model){
                return Yii::$app->user->id;
            }],
            [['translit'],'translitValidation','skipOnEmpty' => false],
        ];
    }


    public function translitValidation($attribute,$params){
        $this->$attribute = trim($this->$attribute);
        if(empty($this->$attribute)){
            foreach(Yii::$app->params['languages'] as $lang=>$info){
                if($this->$attribute){
                    break;
                }
                $this->$attribute = $this->translateModels[$lang]->title;
            }
        }
        $this->$attribute = mb_strtolower(str_replace(' ','-',$this->$attribute));
        $this->$attribute = TransliteratorHelper::process($this->$attribute,'-','en');
        if($this->id){
            if($this->id){             $duplicates = self::find()->andWhere([$attribute=>$this->$attribute])->andWhere('id != '.$this->id)->all();         }
        }

        if(count($duplicates)){
            $this->$attribute .= '-'.$this->id;
        }
    }

    public function dateValidation($attribute, $params){
        if ($this->$attribute) {
            if(is_string($this->$attribute)){
                $this->$attribute = strtotime($this->$attribute);
            }else{
                $this->addError($attribute, Yii::t('backend','Введите корректную дату'));
            }
        }
    }

    public function getCategories(){
        return $this->hasMany(Category::className(), ['id_news' => 'id'])->joinWith('category')->indexBy('id_category');
    }

    public function getTags(){
        return $this->hasMany(Tag::className(), ['id_news' => 'id'])->joinWith('tag')->indexBy('id_tag');
    }

    public function getSource(){
        return $this->hasOne(Source::className(), ['id_news' => 'id'])->joinWith('source')->indexBy('id_source');
    }

    public function getTypes(){
        return $this->hasMany(Type::className(), ['id_news' => 'id'])->indexBy('type_code');
    }

    public function getImages()
    {
        return $this->hasMany(NewsImage::className(), [$this->multilingualKey => $this->modelPrimaryKeyAttribute])->orderBy('order')->indexBy('id');
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend','Ид'),
            'show' => Yii::t('backend','Отображать'),
            'create_date' => Yii::t('backend','Дата создания'),
            'event_date' => Yii::t('backend','Дата события (если тип "Афиша")'),
            'end_date' => Yii::t('backend','Дата окончания'),
            'color' => Yii::t('backend','Цвет (если тип "Точка зрения"")'),
            'title_color' => Yii::t('backend','Цвет заголовка'),
            'photo' => Yii::t('backend','Фото (если тип "Точка зрения" или "Слово общественности" или "Интервью")'),
            'views' => Yii::t('backend','Просмотры'),
            'comments' => Yii::t('backend','Комментарии'),
            'user_id' => Yii::t('backend','Автор'),
            'translit' => Yii::t('backend','Транслит новости'),
        ];
    }

    public function afterSave($insert, $changedAttributes){
        Tag::deleteAll(['id_news'=>$this->id]);
        $tags = !empty(Yii::$app->request->post()['Tag'])?
            Yii::$app->request->post()['Tag']:[];
        if($tags){
            foreach($tags as $tag){
                $model = new Tag();
                $model->id_tag = $tag;
                $model->id_news = $this->id;
                $model->save();
            }
        }
        Source::deleteAll(['id_news'=>$this->id]);
        $source = !empty(Yii::$app->request->post()['Source'])?
            Yii::$app->request->post()['Source']:[];
        if($source){
            $model = new Source();
            $model->id_source = $source;
            $model->id_news = $this->id;
            $model->save();
        }
        Category::deleteAll(['id_news'=>$this->id]);
        $categories = !empty(Yii::$app->request->post()['Category'])?
            Yii::$app->request->post()['Category']:[];
        if($categories){
            foreach($categories as $category){
                $model = new Category();
                $model->id_category = $category;
                $model->id_news = $this->id;
                $model->save();
            }
        }
        Type::deleteAll(['id_news'=>$this->id]);
        $types = !empty(Yii::$app->request->post()['Type'])?
            Yii::$app->request->post()['Type']:[];
        if($types){
            foreach($types as $type){
                $model = new Type();
                $model->type_code = $type;
                $model->id_news = $this->id;
                $model->save();
            }
        }
        parent::afterSave($insert, $changedAttributes);
    }

    public function afterDelete(){
        Tag::deleteAll(['id_news'=>$this->id]);
        Source::deleteAll(['id_news'=>$this->id]);
        Category::deleteAll(['id_news'=>$this->id]);
        Type::deleteAll(['id_news'=>$this->id]);
        if($this->photo){
            $dir = Yii::getAlias('@img_root').DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'NewsPhoto'.DIRECTORY_SEPARATOR.$this->id;
            SmileDropZoneModel::delTree($dir);
        }
        parent::afterDelete();
    }

}
