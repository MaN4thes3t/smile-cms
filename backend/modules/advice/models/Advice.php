<?php

namespace backend\modules\advice\models;

use Yii;

use backend\smile\models\SmileBackendModel;
use yii\helpers\VarDumper;use dosamigos\transliterator\TransliteratorHelper;
/**
 * This is the model class for table "advice".
 *
 * @property integer $id
 * @property integer $show
 *
 */
class Advice extends SmileBackendModel
{

    /**
     * @inheritdoc
     */
    public function init(){
        $this->multilingualModelClassName = AdviceTranslate::className();
        parent::init();
    }

    public static function tableName()
    {
        return 'advice';
    }

    /**
     * @inheritdoc
     */

    public function rules()
    {
        return [
            [['show'], 'required'],
            [['translit'],'translitValidation','skipOnEmpty' => false],
        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend','Ид'),
            'show' => Yii::t('backend','Отображать'),
            'translit' => Yii::t('backend','Транслит совета'),
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
        if($this->id){             $duplicates = self::find()->andWhere([$attribute=>$this->$attribute])->andWhere('id != '.$this->id)->all();         }
        if(count($duplicates)){
            $this->$attribute .= '-'.$this->id;
        }
    }

    public function getTags(){
        return $this->hasMany(Tag::className(), ['id_advice' => 'id'])->joinWith('tag')->indexBy('id_tag');
    }

    public function afterSave($insert, $changedAttributes){
        Tag::deleteAll(['id_advice'=>$this->id]);
        $tags = !empty(Yii::$app->request->post()['Tag'])?
            Yii::$app->request->post()['Tag']:[];
        if($tags){
            foreach($tags as $tag){
                $model = new Tag();
                $model->id_tag = $tag;
                $model->id_advice = $this->id;
                $model->save();
            }
        }
        parent::afterSave($insert, $changedAttributes);
    }

    public function afterDelete(){
        Tag::deleteAll(['id_advice'=>$this->id]);
        parent::afterDelete();
    }

}
