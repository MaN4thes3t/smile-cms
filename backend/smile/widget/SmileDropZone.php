<?php

namespace backend\smile\widget;

use kato\DropZone;
use Yii;
use yii\base\Exception;
use yii\helpers\Url;
use yii\helpers\VarDumper;

class SmileDropZone extends DropZone
{
    public $model;

    public $uploadUrl = '';

    public function init(){
        if(!$this->model){
            throw new Exception('SmileDropZone widget require model');
        }
        $this->options = array_merge([
            'uploadMultiple'=>true,
            'dictDefaultMessage'=>Yii::t('backend','Перетащите файлы сюда'),
            'dictFallbackMessage'=>Yii::t('backend','Ваш браузер не поддерживает drag\'n\'drop загрузку файлов'),
            'dictInvalidFileType'=>Yii::t('backend','Вы не можете загружать файлы таких типов'),
            'dictCancelUpload'=>Yii::t('backend','Остановить загрузку'),
            'dictCancelUploadConfirmation'=>Yii::t('backend','Вы уверены, что хотите установить загрузку?'),
            'dictRemoveFile'=>Yii::t('backend','Удалить файл'),
            'addRemoveLinks'=>true,
            'acceptedFiles'=>'image/jpg,image/png,image/jpeg',
            'parallelUploads'=>1,
            'withCredentials'=>true
        ],$this->options);
        if(!$this->uploadUrl){
            $this->uploadUrl = Url::toRoute(['/dropzone/drop-zone/upload',
                'id'=>$this->model->id,
                'class'=>get_class($this->model)
            ],true);
        }
        $this->clientEvents = array_merge([],$this->clientEvents);
        parent::init();
    }
}
