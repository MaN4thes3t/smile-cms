<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\smile\modules\redactor\controllers;

use yii\redactor\controllers\UploadController;

/**
 * @author Nghia Nguyen <yiidevelop@hotmail.com>
 * @since 2.0
 */
class SmileUploadController extends UploadController
{

    public function actions()
    {
        return [
            'file' => 'backend\smile\modules\redactor\actions\SmileFileUploadAction',
            'image' => 'backend\smile\modules\redactor\actions\SmileImageUploadAction',
            'image-json' => 'yii\redactor\actions\ImageManagerJsonAction',
            'file-json' => 'yii\redactor\actions\FileManagerJsonAction',
        ];
    }

}
