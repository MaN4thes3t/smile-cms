<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\smile\modules\dropzone\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\FileHelper;
use yii\helpers\Inflector;
use yii\helpers\StringHelper;
use yii\helpers\Url;
use yii\helpers\VarDumper;
use yii\web\UploadedFile;

/**
 * @property integer $id
 * @property integer $id_item
 * @property integer $order
 * @property string $name
 * @property string $date
 * @property string $model
 *
 */
class SmileDropZoneModel extends ActiveRecord
{
    const IMG_MAX_WIDTH = 2048;
    const IMG_MIN_WIDTH = 156;
    const IMG_MAX_HEIGHT = 1536;
    const IMG_MIN_HEIGHT = 156;
    const SEPARATOR = DIRECTORY_SEPARATOR;

    protected static $MODELCLASS;

    public $key = 'images';
    public $basePath = '';
    public $root = '';
    public $rootPath = '';
    public $thumbnailsFolder = 'thumbnails';
    public $imageFolder = 'uploads_db';

    protected $_image;
    protected $_thumbnail;
    protected $_id;
    protected $_class;
    protected $_files = [];

    private $_modelId;
    private $_modelClass;

    public function init(){
        parent::init();
        $this->root = Yii::getAlias('@img_root');
        $this->basePath = self::SEPARATOR.$this->imageFolder;
        $this->rootPath = $this->root.self::SEPARATOR.$this->basePath;
    }

    public function rules()
    {
        return [
            [['id_item','name','order','model','date'], 'required'],
            [['name','model'], 'string'],
            [['id_item','order','date'], 'integer'],
        ];
    }

    public function beforeDelete(){
        if (parent::beforeDelete()) {
            $date = getdate($this->date);
            $fileName =
                $this->rootPath.
                self::SEPARATOR.
                self::$MODELCLASS.
                self::SEPARATOR.
                $date['year'].
                self::SEPARATOR.
                $date['mon'].
                self::SEPARATOR.
                $date['mday'].
                self::SEPARATOR.
                $this->id_item
                ;
            $thumbnailFolder = $fileName.self::SEPARATOR.$this->id;
            $fileName = $fileName.self::SEPARATOR.
                $this->name;
            if (file_exists($fileName)) {
                unlink($fileName);
            }
            if (file_exists($thumbnailFolder)){
                $this->delTree($thumbnailFolder);
            }
            return true;
        } else {
            return false;
        }
    }
    public function delTree($dir) {
        $files = array_diff(scandir($dir), array('.','..'));
        foreach ($files as $file) {
            (is_dir("$dir/$file")) ? $this->delTree("$dir/$file") : unlink("$dir/$file");
        }
        return rmdir($dir);
    }
    public function initFields($id,$class){
        $this->_modelClass = $class;
        $this->_modelId = $id;
        self::$MODELCLASS = StringHelper::basename($this->_modelClass);
    }

    public function saveImage($id, $class){
        $this->prepareFiles();
        $this->initFields($id,$class);
        return $this->uploadImage();
    }

    public function uploadImage(){
        $response = [];
        if($this->_files){
            $modelShortClass = self::$MODELCLASS;
            $date = getdate();
            $modelPath = self::SEPARATOR .$modelShortClass.
                self::SEPARATOR .$date['year'].
                self::SEPARATOR .$date['mon'].
                self::SEPARATOR .$date['mday'].
                self::SEPARATOR .$this->_modelId;
            $savePath = $this->rootPath.$modelPath;
            $showPath = $this->basePath.$modelPath;
            if(FileHelper::createDirectory($savePath,0777)){
                foreach ($this->_files as $file) {
                    $fileName = substr(uniqid(md5(rand()), true), 0, 10);
                    $fileName .= '-' . Inflector::slug($file->baseName);
                    $fileName .= '.' . $file->extension;
                    $savePathFile = $savePath.self::SEPARATOR.$fileName;
                    $showPathFile = $showPath.self::SEPARATOR.$fileName;
                    if ($file->saveAs($savePathFile, true)) {
                        $image = Yii::$app->image->load($savePathFile);
                        if($image){
                            $image->resize(self::IMG_MAX_WIDTH,self::IMG_MAX_HEIGHT)->save($savePathFile,80);
                            //save to database logic
                            $model = $this->saveToDb($fileName, $date);
                            if($model){
                                $thumbnailSavePath = $savePath.
                                    self::SEPARATOR.
                                    $model->id.
                                    self::SEPARATOR.
                                    $this->thumbnailsFolder.
                                    self::SEPARATOR.self::IMG_MIN_WIDTH.'x'.self::IMG_MIN_HEIGHT;
                                $thumbnailSavePathFile = $thumbnailSavePath.self::SEPARATOR.$fileName;
                                $thumbnailShowPathFile = $showPath.
                                    self::SEPARATOR.
                                    $model->id.
                                    self::SEPARATOR.
                                    $this->thumbnailsFolder.
                                    self::SEPARATOR.self::IMG_MIN_WIDTH.'x'.self::IMG_MIN_HEIGHT.
                                    self::SEPARATOR.$fileName;
                                if(FileHelper::createDirectory($thumbnailSavePath, 0777)){
                                    $thumbnail = $image->resize(self::IMG_MIN_WIDTH,self::IMG_MIN_HEIGHT)->save($thumbnailSavePathFile,80);
                                    if($thumbnail){
                                        $response['files'][] = [
                                            'name' => $file->baseName,
                                            'type' => $file->type,
                                            'size' => $file->size,
                                            'url' => $showPathFile,
                                            'thumbnailUrl' =>$thumbnailShowPathFile,
                                            'id_image'=>$model->id,
                                            'order_image'=>$model->order,
                                            'class'=>$this->_modelClass,
                                            'class_id'=>$this->_modelId,
                                            'deleteUrl' => Url::to(
                                                [
                                                    '/dropzone/drop-zone/delete',
                                                    'class'=>$this->_modelClass,
                                                    'id_image'=>$model->id,
                                                    'id'=>$this->_modelId
                                                ]
                                            ),
                                            'deleteType' => 'GET'
                                        ];
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        return $response;
    }

    public function saveToDb($fileName, $date){
        $model = new self();
        $model->id_item = $this->_modelId;
        $model->name = $fileName;
        $model->model = self::$MODELCLASS;
        $model->date = !empty($date[0])?$date[0]:time();
        $model->order = (int)@$this->find()->where([
            'model'=>$model->model,
            'id_item'=>$model->id_item
        ])->max('`order`')+1;
        $res = $model->save();
        if($res){
            return $model;
        }
        return [];
    }

    public static function tableName()
    {
        return strtolower(self::$MODELCLASS).'_image';
    }

    public function prepareFiles(){
        if(!$this->_files){
            $this->_files = UploadedFile::getInstancesByName($this->key)?
                UploadedFile::getInstancesByName($this->key):[UploadedFile::getInstanceByName($this->key)];
        }
        return $this->_files;
    }
}
