<?php

namespace backend\modules\news\models;

use Yii;

use backend\smile\models\SmileBackendModel;

use yii\helpers\VarDumper;
/**
 * This is the model class for table "news_tag".
 *
 * @property integer $id_tag
 * @property integer $id_news
 *
 */
class Tag extends SmileBackendModel
{

    /**
     * @inheritdoc
     */

    public static function tableName()
    {
        return 'news_tag';
    }

    /**
     * @inheritdoc
     */

    public function rules()
    {
        return [
            [['id_tag','id_news'], 'required'],
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
