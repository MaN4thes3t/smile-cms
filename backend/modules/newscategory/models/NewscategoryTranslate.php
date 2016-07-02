<?php

namespace backend\modules\newscategory\models;

use Yii;
use backend\smile\models\SmileBackendModelTranslate;

/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property string $language
 * @property integer $id_item
 * @property string $name
 * @property string $translit
 *
 */
class NewscategoryTranslate extends SmileBackendModelTranslate
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category_translate';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['language','name'], 'required'],
            [['id_item'], 'required', 'on'=>'ownerUpdate'],
            [['id_item'], 'integer'],
            [['language'], 'string', 'max' => 16],
            [['name','seokeywords', 'seotitle', 'seodescription'], 'string'],
            ['seotitle','default','value'=>function($model){
                return $model->name;
            }],
            ['seokeywords','default','value'=>function($model){
                $keywords = [];
                foreach(explode(' ',$model->name) as $title){
                    if($title && is_string($title) && strlen($title)>2){
                        $keywords[] = mb_strtolower($title);
                    }
                }
                return implode(', ', $keywords);
            }],
            ['seodescription','default','value'=>function($model){
                return $model->name;
            }],

        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('backend','Название'),
            'seotitle' => Yii::t('backend','SEO-title'),
            'seokeywords' => Yii::t('backend','SEO-keywords'),
            'seodescription' => Yii::t('backend','SEO-description'),
        ];
    }
}
