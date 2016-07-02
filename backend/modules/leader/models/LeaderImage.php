<?php

namespace backend\modules\leader\models;

use yii;

use backend\smile\models\SmileBackendModel;
use backend\smile\modules\dropzone\models\SmileDropZoneModel;
use yii\db\ActiveRecord;
use yii\helpers\StringHelper;
use yii\helpers\VarDumper;

class LeaderImage extends ActiveRecord
{

    public static function tableName()
    {
        return 'leader_image';
    }

}
