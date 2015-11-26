<?php

namespace backend\modules\advice\models;

use Yii;

use backend\smile\models\SmileBackendModel;

use yii\helpers\VarDumper;
/**
 * This is the model class for table "tag".
 *
 * @property integer $id_tag
 * @property integer $id_advice
 *
 */
class Tag extends SmileBackendModel
{

    /**
     * @inheritdoc
     */

    public static function tableName()
    {
        return 'advice_tag';
    }

    /**
     * @inheritdoc
     */

    public function rules()
    {
        return [
            [['id_tag','id_advice'], 'required'],
        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
        ];
    }

    public function getTag(){
        return $this->hasOne(\backend\modules\tag\models\Tag::className(), ['id' => 'id_tag'])->with('t');
    }

}
