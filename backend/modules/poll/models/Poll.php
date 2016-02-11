<?php

namespace backend\modules\poll\models;

use Yii;

use backend\smile\models\SmileBackendModel;

use yii\helpers\StringHelper;
use yii\helpers\VarDumper;
/**
 * This is the model class for table "poll".
 *
 * @property integer $id
 * @property integer $show
 * @property integer $type
 * @property integer $my_version
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
            [['show','type'], 'required'],
        ];
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
            'show' => Yii::t('backend','Отображать'),
            'type' => Yii::t('backend','Тип опроса'),
            'my_version' => Yii::t('backend','Мой вариант'),
        ];
    }
    public function afterSave($insert, $changedAttributes){
        $classAnswer = StringHelper::basename(get_class(new Answer()));
        $classAnswerTranslate = StringHelper::basename(get_class(new AnswerTranslate()));
        if(Yii::$app->request->post()[$classAnswer]){
            $answers = Yii::$app->request->post()[$classAnswer];
            if($answers['new']){ //new
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
                }else{
                    foreach(Yii::$app->params['languages'] as $lang=>$info){
                        $model->multilingualArr[$classAnswerTranslate][$lang]['title'] = $answer[$lang]['title'];
                    }
                    $model->save();
                }
            }
        }
        parent::afterSave($insert, $changedAttributes);
    }
}
