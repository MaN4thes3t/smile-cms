<?php

namespace backend\modules\language\models;

use Yii;

use backend\smile\models\SmileBackendModel;

use yii\helpers\VarDumper;
/**
 * This is the model class for table "language".
 *
 * @property integer $id
 * @property string $code
 * @property mixed $name
 * @property integer $is_default
 * @property integer $show
 *
 */
class Language extends SmileBackendModel
{

    /**
     * @inheritdoc
     */
    public function init(){
        $this->multilingualModelClassName = LanguageTranslate::className();
        parent::init();
    }

    public static function tableName()
    {
        return 'language';
    }

    /**
     * @inheritdoc
     */

    public function rules()
    {
        return [
            [['code', 'name', 'is_default', 'show'], 'required'],
            [['code', 'name'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'code' => Yii::t('backend','Код'),
            'name' => Yii::t('backend','Названия'),
            'is_default' => Yii::t('backend','По-умолчанию'),
            'show' => Yii::t('backend','Отображать'),
        ];
    }

}
