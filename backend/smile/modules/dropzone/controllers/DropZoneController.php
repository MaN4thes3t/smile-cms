<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\smile\modules\dropzone\controllers;
use yii\helpers\VarDumper;
use Yii;
use yii\helpers\StringHelper;
use yii\helpers\Inflector;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;

/**
 * @author Nghia Nguyen <yiidevelop@hotmail.com>
 * @since 2.0
 */
class DropZoneController extends \yii\web\Controller
{
    const IMG_MAX_WIDTH = 2048;
    const IMG_MAX_HEIGHT = 1536;
    public function actionUpload()
    {
        $uploadPath = Yii::getAlias('@img_root').'/uploads_db';
        if (isset($_FILES['file']) && Yii::$app->request->get('id') && Yii::$app->request->get('class')) {
            $files = UploadedFile::getInstancesByName('file');
            $model_id = Yii::$app->request->get('id');
            $model_class = Yii::$app->request->get('class');
            $model_short_class = StringHelper::basename($model_class);
            $date = getdate();
            $result = [];

            if(!$files){
                $files = [UploadedFile::getInstanceByName('file')];
            }
            $path = $uploadPath . DIRECTORY_SEPARATOR . $model_short_class . DIRECTORY_SEPARATOR .
                $date['year']. DIRECTORY_SEPARATOR . $date['mon'] . DIRECTORY_SEPARATOR . $date['mday'].DIRECTORY_SEPARATOR. $model_id;
            if (FileHelper::createDirectory($path, 0777)) {
                foreach($files as $file){
                    $fileName = substr(uniqid(md5(rand()), true), 0, 10);
                    $fileName .= '-' . Inflector::slug($file->baseName);
                    $fileName .= '.' . $file->extension;
                    $pathFile = $path.DIRECTORY_SEPARATOR.$fileName;
                    if ($file->saveAs($pathFile, true)) {
                        $image = Yii::$app->image->load($pathFile);
                        if($image){
                            $image->resize(self::IMG_MAX_WIDTH,self::IMG_MAX_HEIGHT)->save($pathFile,80);
                        }
                        //need add save to database
                        $result[] = $file;
                    }
                }
                return \yii\helpers\Json::encode($result);
            }
        }
        return false;
   }

}
