<?php

namespace backend\modules\tag\models;

use Yii;

use backend\smile\models\SmileBackendModel;

use yii\helpers\VarDumper;
/**
 * This is the model class for table "tag".
 *
 * @property integer $id
 * @property integer $show
 *
 */
class Tag extends SmileBackendModel
{

    /**
     * @inheritdoc
     */
    public function init(){
        $this->multilingualModelClassName = TagTranslate::className();
        parent::init();
    }

    public static function tableName()
    {
        return 'tag';
    }

    /**
     * @inheritdoc
     */

    public function rules()
    {
        return [
            [['show'], 'required']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'show' => Yii::t('backend','Отображать'),
        ];
    }

}
