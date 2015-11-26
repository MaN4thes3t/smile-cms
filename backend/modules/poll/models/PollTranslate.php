<?php

namespace backend\modules\poll\models;

use Yii;
use backend\smile\models\SmileBackendModelTranslate;
use yii\helpers\VarDumper;
use yii\helpers\StringHelper;

/**
 * This is the model class for table "poll_translate".
 *
 * @property integer $id
 * @property string $language
 * @property integer $id_item
 * @property string $title
 *
 */
class PollTranslate extends SmileBackendModelTranslate
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
    }

    public static function tableName()
    {
        return 'poll_translate';
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
            [['title'], 'string'],
        ];
    }

    public function getAnswers(){
        return $this->hasMany(Answer::className(), ['id_poll_tr' => 'id'])->indexBy('id');
    }

    /**
     * @inheritdoc
     */

    public function attributeLabels()
    {
        return [
            'title' => Yii::t('backend','Заголовок'),
        ];
    }

    public function afterSave($insert, $changedAttributes){
        $class = StringHelper::basename(get_class($this));
        $classAnswer = StringHelper::basename(get_class(new Answer()));
        $answers = !empty(Yii::$app->request->post()[$class][$this->language][$classAnswer])?
            Yii::$app->request->post()[$class][$this->language][$classAnswer]:[];

        if(!empty($answers['new'])){
            foreach($answers['new'] as $answer){
                if($answer['title'] != 'deleted'){
                    $model = new Answer();
                    $model->title = $answer['title'];
                    $model->id_poll_tr = $this->id;
                    $model->save();
                }
            }
            unset($answers['new']);
        }
        foreach($answers as $key => $answer){
            $model = Answer::findOne($key);
            if($answer['title'] == 'deleted'){
                $model->delete();
            }else{
                $model->title = $answer['title'];
                $model->save();
            }
        }
        parent::afterSave($insert, $changedAttributes);
    }

    public function afterDelete(){
        Answer::deleteAll(['id_poll_tr'=>$this->id]);
    }
}
