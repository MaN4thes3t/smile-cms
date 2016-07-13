<?php

namespace backend\modules\newscategory\models;

use backend\modules\news\models\Category;
use Yii;

use backend\smile\models\SmileBackendModel;

use yii\helpers\VarDumper;
use dosamigos\transliterator\TransliteratorHelper;
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
            [['translit'],'translitValidation','skipOnEmpty' => false],
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
            'translit' => Yii::t('backend','Транслит категории'),
        ];
    }
    public function translitValidation($attribute,$params){
        $this->$attribute = trim($this->$attribute);
        if(empty($this->$attribute)){
            foreach(Yii::$app->params['languages'] as $lang=>$info){
                if($this->$attribute){
                    break;
                }
                $this->$attribute = $this->translateModels[$lang]->name;
            }
        }
        $this->$attribute = mb_strtolower(str_replace(' ','-',$this->$attribute));
        $this->$attribute = TransliteratorHelper::process($this->$attribute,'-','en');
        if($this->id){             $duplicates = self::find()->andWhere([$attribute=>$this->$attribute])->andWhere('id != '.$this->id)->all();         }
        if(count($duplicates)){
            $this->$attribute .= '-'.$this->id;
        }
    }

    public function getNewsCategory(){
        return $this->hasMany(Category::className(), ['id_category' => $this->modelPrimaryKeyAttribute])
            ->joinWith(['news']);
    }

    public function afterDelete(){
        Category::deleteAll(['id_category'=>$this->id]);
        parent::afterDelete();
    }

}
