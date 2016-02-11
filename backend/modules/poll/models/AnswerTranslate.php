<?php

namespace backend\modules\poll\models;

use backend\smile\models\SmileBackendModelTranslate;
use Yii;

use backend\smile\models\SmileBackendModel;

use yii\helpers\VarDumper;
/**
 * This is the model class for table "poll_answer_translate".
 *
 * @property integer $id
 * @property string $language
 * @property integer $id_item
 * @property string $title
 *
 */
class AnswerTranslate extends SmileBackendModelTranslate
{
    /**
     * @inheritdoc
     */
    public function init(){
        parent::init();
    }

    public static function tableName()
    {
        return 'poll_answer_translate';
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
