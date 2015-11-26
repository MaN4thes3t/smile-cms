<?php

namespace backend\modules\dictionary\models;

use Yii;
use backend\smile\models\SmileBackendModelTranslate;
/**
 * This is the model class for table "dictionary_translate".
 *
 * @property integer $id
 * @property string $language
 * @property integer $id_item
 * @property string $translation
 *
 */
class DictionaryTranslate extends SmileBackendModelTranslate
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dictionary_translate';
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
            [['translation'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'translation' => Yii::t('backend','Перевод'),
        ];
    }
}
