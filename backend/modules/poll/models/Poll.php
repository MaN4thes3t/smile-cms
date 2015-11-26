<?php

namespace backend\modules\poll\models;

use Yii;

use backend\smile\models\SmileBackendModel;

use yii\helpers\VarDumper;
/**
 * This is the model class for table "poll".
 *
 * @property integer $id
 * @property integer $show
 * @property integer $type
 *
 */
class Poll extends SmileBackendModel
{
    CONST TYPE_ONE = 1;
    CONST TYPE_MANY = 2;
    public static $POLL_TYPES = [];
    /**
     * @inheritdoc
     */
    public function init(){
        $this->multilingualModelClassName = PollTranslate::className();
        self::$POLL_TYPES = [
            self::TYPE_ONE => Yii::t('backend','Один вариант ответа'),
            self::TYPE_MANY => Yii::t('backend','Много вариантов ответов'),
        ];
        parent::init();
    }

    public static function tableName()
    {
        return 'poll';
    }

    /**
     * @inheritdoc
     */

    public function rules()
    {
        return [
            [['show','type'], 'required'],
        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'show' => Yii::t('backend','Отображать'),
            'type' => Yii::t('backend','Тип опроса'),
        ];
    }

}
