<?php

namespace backend\modules\newscategory\models;

use backend\modules\news\models\Category;
use Yii;

use backend\smile\models\SmileBackendModel;

use yii\helpers\VarDumper;
/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property integer $show
 * @property integer $show_in_menu
 * @property integer $show_in_left_menu
 *
 */
class Newscategory extends SmileBackendModel
{

    /**
     * @inheritdoc
     */
    public function init(){
        $this->multilingualModelClassName = NewscategoryTranslate::className();
        parent::init();
    }

    public static function tableName()
    {
        return 'category';
    }

    /**
     * @inheritdoc
     */

    public function rules()
    {
        return [
            [['show','show_in_menu','show_in_left_menu'], 'required'],
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
            'show_in_menu' => Yii::t('backend','Отображать в меню'),
            'show_in_left_menu' => Yii::t('backend','Отображать в левом меню'),
        ];
    }

    public function afterDelete(){
        Category::deleteAll(['id_category'=>$this->id]);
        parent::afterDelete();
    }

}
