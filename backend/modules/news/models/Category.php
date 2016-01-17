<?php

namespace backend\modules\news\models;

use Yii;

use backend\smile\models\SmileBackendModel;

use yii\helpers\VarDumper;
/**
 * This is the model class for table "news_category".
 *
 * @property integer $id_category
 * @property integer $id_news
 *
 */
class Category extends SmileBackendModel
{

    /**
     * @inheritdoc
     */

    public static function tableName()
    {
        return 'news_category';
    }

    /**
     * @inheritdoc
     */

    public function rules()
    {
        return [
            [['id_category','id_news'], 'required'],
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

    public function getCategory(){
        return $this->hasOne(\backend\modules\newscategory\models\Newscategory::className(), ['id' => 'id_category'])->with('t');
    }

}
