<?php

namespace backend\modules\dictionary\models;

use Yii;

use backend\smile\models\SmileBackendModel;

use yii\helpers\VarDumper;
/**
 * This is the model class for table "dictionary".
 *
 * @property integer $id
 * @property string $category
 * @property string $message
 *
 */
class Dictionary extends SmileBackendModel
{

    /**
     * @inheritdoc
     */
    public function init(){
        $this->multilingualModelClassName = DictionaryTranslate::className();
        parent::init();
    }

    public static function tableName()
    {
        return 'dictionary';
    }

    /**
     * @inheritdoc
     */

    public function rules()
    {
        return [
            [['category', 'message'], 'required'],
            [['category', 'message'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend','Ид'),
            'category' => Yii::t('backend','Категория'),
            'message' => Yii::t('backend','Код'),
        ];
    }

}
