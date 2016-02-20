<?php

namespace backend\modules\advice\models;

use Yii;

use backend\smile\models\SmileBackendModel;
use yii\helpers\VarDumper;
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
        ];
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
