<?php

namespace backend\modules\page\models;

use Yii;
use backend\smile\models\SmileBackendModelTranslate;
/**
 * This is the model class for table "page_translate".
 *
 * @property integer $id
 * @property string $language
 * @property integer $id_item
 * @property string $description
 * @property string $title
 * @property string $seotitle
 * @property string $seokeywords
 * @property string $seodescription
 *
 */
class PageTranslate extends SmileBackendModelTranslate
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'page_translate';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['language'], 'required'],
            [['id_item'], 'required', 'on'=>'ownerUpdate'],
            [['id_item'], 'integer'],
            [['language'], 'string', 'max' => 16],
            [['description'], 'string'],
            [['title'], 'string'],
            [['seotitle'], 'string'],
            [['seokeywords'], 'string'],
            [['seodescription'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'title' => Yii::t('backend','Заголовок'),
            'seotitle' => Yii::t('backend','SEO-title'),
            'seokeywords' => Yii::t('backend','SEO-keywords'),
            'seodescription' => Yii::t('backend','SEO-description'),
            'description' => Yii::t('backend','Описание'),
        ];
    }
}
