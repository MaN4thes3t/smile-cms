<?php

namespace backend\modules\source\models;

use Yii;
use backend\smile\models\SmileBackendModelTranslate;
/**
 * This is the model class for table "source_translate".
 *
 * @property integer $id
 * @property string $language
 * @property integer $id_item
 * @property string $name
 *
 */
class SourceTranslate extends SmileBackendModelTranslate
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'source_translate';
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
            [['name'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('backend','Название'),
        ];
    }
}
