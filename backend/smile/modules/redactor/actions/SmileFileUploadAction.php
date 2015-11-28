<?php

namespace backend\smile\modules\redactor\actions;

use Yii;
use yii\base\Action;
use yii\redactor\actions\FileUploadAction;
use backend\smile\modules\redactor\models\SmileFileUploadModel;

/**
 * @author Nghia Nguyen <yiidevelop@hotmail.com>
 * @since 2.0
 */
class SmileFileUploadAction extends FileUploadAction
{
    function run()
    {
        if (isset($_FILES)) {
            $model = new SmileFileUploadModel();
            if ($model->upload()) {
                return $model->getResponse();
            } else {
                return ['error' => 'Unable to save file'];
            }
        }
    }

}
