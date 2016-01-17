<?php

namespace backend\modules\news\models;

use Yii;

use backend\smile\models\SmileBackendModel;

use yii\helpers\VarDumper;
/**
 * This is the model class for table "news_type".
 *
 * @property integer $type_code
 * @property integer $id_news
 *
 */
class Type extends SmileBackendModel
{
    static $TYPES = [];

    /**
     * @inheritdoc
     */

    public static function getTypes(){
        self::$TYPES = [
            'news_one'=>Yii::t('backend','News One'),
            'video_news'=>Yii::t('backend','Video News'),
            'photo_news'=>Yii::t('backend','Photo News'),
            'analytics'=>Yii::t('backend','Analytics'),
            'point_of_view'=>Yii::t('backend','Point of view'), //точка зору
            'poster'=>Yii::t('backend','Poster'), //афиша
            'focus_of_the_week'=>Yii::t('backend','Focus of the week'), //акцент тиэня
            'interview'=>Yii::t('backend','Interview'),
            'the_word_public'=>Yii::t('backend','The word public'), //Слово общественности
        ];
        return self::$TYPES;
    }
    public static function tableName()
    {
        return 'news_type';
    }

    /**
     * @inheritdoc
     */

    public function rules()
    {
        return [
            [['type_code','id_news'], 'required'],
        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
        ];
    }

}
