<?php

namespace backend\modules\poll\models;

use Yii;

use backend\smile\models\SmileBackendModel;

use yii\helpers\StringHelper;
use yii\helpers\VarDumper;
use yii\helpers\Json;
use dosamigos\transliterator\TransliteratorHelper;
/**
 * This is the model class for table "poll".
 *
 * @property integer $id
 * @property integer $show
 * @property integer $type
 * @property integer $my_version
 * @property integer $my_version_count
 * @property integer $my_version_text
 *
 */
class Poll extends SmileBackendModel
{
    CONST TYPE_ONE = 1;
    CONST TYPE_MANY = 2;
    public static $POLL_TYPES = [];
    /**
     * @inheritdoc
     */
    public function init(){
        $this->multilingualModelClassName = PollTranslate::className();
        self::$POLL_TYPES = [
            self::TYPE_ONE => Yii::t('backend','Один вариант ответа'),
            self::TYPE_MANY => Yii::t('backend','Много вариантов ответов'),
        ];
        parent::init();
    }

    public static function tableName()
    {
        return 'poll';
    }

    /**
     * @inheritdoc
     */

    public function rules()
    {
        return [
            [['show','type','my_version'], 'required'],
            [['my_version_text'], 'versionsValidation'],
            [['my_version_count'], 'double'],
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
        $duplicates = self::find()->where([$attribute=>$this->$attribute])->all();
        if(count($duplicates)){
            $this->$attribute .= '-'.$this->id;
        }
    }

    public function versionsValidation($attribute, $params){
        $this->my_version_count = count(Yii::$app->request->post('my_version'));
        $this->$attribute = Json::encode(Yii::$app->request->post('my_version'));
    }

    public function getAnswers(){
        return $this->hasMany(Answer::className(), ['id_poll' => 'id'])->with('translate')->indexBy('id');
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend','Ид'),
            'show' => Yii::t('backend','Отображать'),
            'type' => Yii::t('backend','Тип опроса'),
            'my_version' => Yii::t('backend','Мой вариант'),
            'my_version_text' => Yii::t('backend','Варианты'),
            'translit' => Yii::t('backend','Транслит опроса'),
        ];
    }
    public function afterSave($insert, $changedAttributes){
        $classAnswer = StringHelper::basename(get_class(new Answer()));
        $classAnswerTranslate = StringHelper::basename(get_class(new AnswerTranslate()));

        if(Yii::$app->request->post($classAnswer)){
            $answers = Yii::$app->request->post($classAnswer);
            if(!empty($answers['new'])){ //new
                $new_arr = $answers['new'];
                if($new_arr[Yii::$app->language]){
                    foreach($new_arr[Yii::$app->language] as $key=>$arr){
                        $model = new Answer();
                        $model->id_poll = $this->id;
                        foreach(Yii::$app->params['languages'] as $lang=>$info){
                            $model->multilingualArr[$classAnswerTranslate][$lang]['title'] = $new_arr[$lang][$key]['title'];
                        }
                        $model->attachMultilingual();
                        $model->save();
                    }
                }
                unset($answers['new']);
            }
            foreach($answers as $key => $answer){
                $model = Answer::findOne($key);
                $model->attachMultilingual();
                if($answer[Yii::$app->language]['title'] == 'deleted'){
                    $model->delete();
                    continue;
                }
                foreach(Yii::$app->params['languages'] as $lang=>$info){
                    $model->multilingualArr[$classAnswerTranslate][$lang]['title'] = $answer[$lang]['title'];
                }
                $model->attachMultilingual();
                $model->save();
            }
        }
        parent::afterSave($insert, $changedAttributes);
    }
    public function afterDelete(){
        $answers = Answer::findAll(['id_poll'=>$this->id]);
        foreach($answers as $answer){
            $answer->attachMultilingual();
            $answer->delete();
        }
        parent::afterDelete();
    }
}
