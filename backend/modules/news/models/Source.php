<?php

namespace backend\modules\news\models;

use Yii;

use backend\smile\models\SmileBackendModel;

use yii\helpers\VarDumper;
/**
 * This is the model class for table "news_source".
 *
 * @property integer $id_source
 * @property integer $id_news
 *
 */
class Source extends SmileBackendModel
{

    /**
     * @inheritdoc
     */

    public static function tableName()
    {
        return 'news_source';
    }

    /**
     * @inheritdoc
     */

    public function rules()
    {
        return [
            [['id_source','id_news'], 'required'],
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

    public function getSource(){
        return $this->hasOne(\backend\modules\source\models\Source::className(), ['id' => 'id_source'])->with('t');
    }

}
