<?php

namespace backend\modules\poll\models;

use Yii;
use backend\smile\models\SmileBackendModelTranslate;
use yii\helpers\VarDumper;
use yii\helpers\StringHelper;


/**
 * This is the model class for table "poll_translate".
 *
 * @property integer $id
 * @property string $language
 * @property integer $id_item
 * @property string $title
 *
 */
class PollTranslate extends SmileBackendModelTranslate
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
    }

    public static function tableName()
    {
        return 'poll_translate';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['language','title'], 'required'],
            [['id_item'], 'required', 'on'=>'ownerUpdate'],
            [['id_item'], 'integer'],
            [['language'], 'string', 'max' => 16],
            [['title','seodescription','seotitle'], 'string'],
            ['seotitle','default','value'=>function($model){
                return $model->title;
            }],
            ['seokeywords','default','value'=>function($model){
                $keywords = [];
                foreach(explode(' ',$model->title) as $title){
                    if($title && is_string($title) && strlen($title)>2){
                        $keywords[] = mb_strtolower($title);
                    }
                }
                return implode(', ', $keywords);
            }],
            ['seodescription','default','value'=>function($model){
                return $model->title;
            }],
        ];
    }

    /**
     * @inheritdoc
     */

    public function attributeLabels()
    {
        return [
            'title' => Yii::t('backend','Заголовок'),
            
        ];
    }
}
