<?php

namespace backend\modules\poll\models;

use Yii;

use backend\smile\models\SmileBackendModel;

use yii\helpers\VarDumper;
/**
 * This is the model class for table "poll_answer".
 *
 * @property integer $id
 * @property integer $id_poll
 * @property integer $count_answers
 *
 */
class Answer extends SmileBackendModel
{
    /**
     * @inheritdoc
     */
    public function init(){
        $this->multilingualModelClassName = AnswerTranslate::className();
        parent::init();
    }

    public static function tableName()
    {
        return 'poll_answer';
    }

    /**
     * @inheritdoc
     */

    public function rules()
    {
        return [
            [['id_poll'], 'required'],
            [['count_answers'], 'double'],
        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'count_answers'=>Yii::t('backend','Количество ответов'),
        ];
    }

}
