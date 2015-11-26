<?php

namespace backend\modules\language\models;

use Yii;
use backend\smile\models\SmileBackendModelTranslate;
/**
 * This is the model class for table "language_translate".
 *
 * @property integer $id
 * @property string $language
 * @property string $translate
 *
 */
class LanguageTranslate extends SmileBackendModelTranslate
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'language_translate';
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
            [['translate'], 'string', 'max' => 255],
            [['language'], 'string', 'max' => 16],
            [['description'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'translate' => Yii::t('backend','Перевод'),
            'description' => Yii::t('backend','Описание'),
        ];
    }
}
