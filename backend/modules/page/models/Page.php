<?php

namespace backend\modules\page\models;

use yii;
use dosamigos\transliterator\TransliteratorHelper;
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
            [['show'], 'required'],
            [['order'], 'integer'],
            [['translit'],'translitValidation','skipOnEmpty' => false],
        ];
    }
    public function translitValidation($attribute,$params){
        $this->$attribute = trim($this->$attribute);
        if(empty($this->$attribute)){
            foreach(Yii::$app->params['languages'] as $lang=>$info){
                if($this->$attribute){
                    break;
                }
                $this->$attribute = $this->translateModels[$lang]->title;
            }
        }
        $this->$attribute = mb_strtolower(str_replace(' ','-',$this->$attribute));
        $this->$attribute = TransliteratorHelper::process($this->$attribute,'-','en');
        if($this->id){             $duplicates = self::find()->andWhere([$attribute=>$this->$attribute])->andWhere('id != '.$this->id)->all();         }
        if(count($duplicates)){
            $this->$attribute .= '-'.$this->id;
        }
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend','Ид'),
            'show' => Yii::t('backend','Отображать'),
            'translit' => Yii::t('backend','Транслит страницы'),
            'order' => Yii::t('backend','Сортировка'),
        ];
    }

}
