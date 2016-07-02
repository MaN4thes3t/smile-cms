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
        if(!self::$TYPES){
            self::$TYPES = [
                'zhitomir_live'=>Yii::t('backend','Житомир LIVE'),
                'news_one'=>Yii::t('backend','News One'),
                'cookery'=>Yii::t('backend','Кулинария'),
                'video_news'=>Yii::t('backend','Видео новости'),
                'photo_news'=>Yii::t('backend','Фото новости'),
                'analytics'=>Yii::t('backend','Аналитика'),
                'point_of_view'=>Yii::t('backend','Точка зрения'),
                'poster'=>Yii::t('backend','Афиша'),
                'focus_of_the_week'=>Yii::t('backend','Акцент недели'),
                'interview'=>Yii::t('backend','Интервью'),
                'the_word_public'=>Yii::t('backend','Слово общественности'),
            ];
        }
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
