<?php
/**
 * Created by PhpStorm.
 * User: Kate
 * Date: 11.02.15
 * Time: 9:23
 */
namespace backend\smile\components;

use Yii;
use yii\helpers\VarDumper;
use yii\helpers\Html;

class SmileHtml extends Html
{
    public static function activeEnumDropDownList($model, $attribute, $htmlOptions = [])
    {
        return self::activeDropDownList( $model, $attribute, self::enumItem($model,  $attribute), $htmlOptions);
    }

    public static function enumItem($model,$attribute) {
        $values = [];
        preg_match('/\((.*)\)/', $model->tableSchema->columns[$attribute]->dbType, $matches);
        foreach(explode(',', $matches[1]) as $value) {
            $value = str_replace("'", null, $value);
            $values[$value] = Yii::t('app', $value);
        }
        return $values;
    }
}