<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\smile\modules\redactor\actions;

use Yii;
use backend\smile\modules\redactor\models\SmileImageUploadModel;
use yii\redactor\actions\ImageUploadAction;
/**
 * @author Nghia Nguyen <yiidevelop@hotmail.com>
 * @since 2.0
 */
class SmileImageUploadAction extends ImageUploadAction
{
    function run()
    {
        if (isset($_FILES)) {
            $model = new SmileImageUploadModel();
            if ($model->upload()) {
                return $model->getResponse();
            } else {
                return ['error' => 'Unable to save image file'];
            }
        }
    }

}
