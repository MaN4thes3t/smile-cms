<?php

namespace backend\modules\page\models;

use Yii;

use backend\smile\models\SmileBackendModel;

use yii\helpers\VarDumper;
/**
 * This is the model class for table "page".
 *
 * @property integer $id
 * @property integer $show
 * @property integer $show_in_menu
 *
 */
class Page extends SmileBackendModel
{

    /**
     * @inheritdoc
     */
    public function init(){
        $this->multilingualModelClassName = PageTranslate::className();
        parent::init();
    }

    public static function tableName()
    {
        return 'page';
    }

    /**
     * @inheritdoc
     */

    public function rules()
    {
        return [
            [['show', 'show_in_menu'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'show' => Yii::t('backend','Отображать'),
            'show_in_menu' => Yii::t('backend','Отображать в меню'),
        ];
    }

}
