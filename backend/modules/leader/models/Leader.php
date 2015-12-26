<?php

namespace backend\modules\leader\models;

use Yii;

use backend\smile\models\SmileBackendModel;

use yii\helpers\VarDumper;
/**
 * This is the model class for table "leader".
 *
 * @property integer $id
 * @property integer $show
 * @property integer $birthday
 *
 */
class Leader extends SmileBackendModel
{

    /**
     * @inheritdoc
     */
    public function init(){
        $this->multilingualModelClassName = LeaderTranslate::className();
        parent::init();
    }

    public static function tableName()
    {
        return 'leader';
    }

    /**
     * @inheritdoc
     */

    public function rules()
    {
        return [
            [['show'], 'required'],
            [['birthday'], 'string'],
            [['birthday'], 'birthdayValidation']
        ];
    }
    public function birthdayValidation($attribute, $params){
        $this->save();
        if ($this->$attribute) {

            if(is_string($this->$attribute)){
//                VarDumper::dump($this->$attribute,6,1);
//                die();
                $this->$attribute = strtotime($this->$attribute);

            }else{
                $this->addError($attribute, Yii::t('backend','Введите корректную дату'));
            }
        }

    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'show' => Yii::t('backend','Отображать'),
            'birthday' => Yii::t('backend','День рождения'),
        ];
    }

}
