<?php

namespace backend\modules\tag\models;

use Yii;
use backend\smile\models\SmileBackendModelTranslate;
/**
 * This is the model class for table "tag_translate".
 *
 * @property integer $id
 * @property string $language
 * @property integer $id_item
 * @property string $text
 *
 */
class TagTranslate extends SmileBackendModelTranslate
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tag_translate';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['language','text'], 'required'],
            [['id_item'], 'required', 'on'=>'ownerUpdate'],
            [['id_item'], 'integer'],
            [['language'], 'string', 'max' => 16],
            [['text'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'text' => Yii::t('backend','Тег'),
        ];
    }
}
