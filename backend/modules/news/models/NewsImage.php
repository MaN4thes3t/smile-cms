<?php
/**
 * Created by PhpStorm.
 * User: Артём
 * Date: 28.06.2016
 * Time: 0:29
 */

namespace backend\modules\news\models;
use yii\db\ActiveRecord;

class NewsImage extends ActiveRecord
{
    public static function tableName()
    {
        return 'news_image';
    }
}