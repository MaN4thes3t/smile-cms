<?php

namespace backend\modules\poll\models;

use Yii;

use backend\smile\models\SmileBackendModel;

use yii\helpers\VarDumper;
/**
 * This is the model class for table "poll_answer".
 *
 * @property integer $id
 * @property string $title
 * @property integer $id_poll_tr
 * @property integer $count_answers
 *
 */
class Answer extends SmileBackendModel
{
    /**
     * @inheritdoc
     */
    public function init(){
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
            [['id_poll_tr'], 'required'],
            [['title'], 'string'],
            [['id_poll_tr'], 'integer'],
        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'title' => Yii::t('backend','Вариант ответа'),
        ];
    }

}
