<?php

namespace backend\modules\source\models;

use Yii;

use backend\smile\models\SmileBackendModel;

use yii\helpers\VarDumper;
/**
 * This is the model class for table "source".
 *
 * @property integer $id
 * @property integer $show
 * @property integer $link
 *
 */
class Source extends SmileBackendModel
{

    /**
     * @inheritdoc
     */
    public function init(){
        $this->multilingualModelClassName = SourceTranslate::className();
        parent::init();
    }

    public static function tableName()
    {
        return 'source';
    }

    /**
     * @inheritdoc
     */

    public function rules()
    {
        return [
            [['show','link'], 'required']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend','Ид'),
            'show' => Yii::t('backend','Отображать'),
            'link' => Yii::t('backend','Ссылка'),
        ];
    }

    public function afterDelete(){
        \backend\modules\news\models\Source::deleteAll(['id_source'=>$this->id]);
        parent::afterDelete();
    }

}
