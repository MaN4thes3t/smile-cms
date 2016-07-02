<?php

namespace frontend\smile\components;

use backend\smile\modules\dropzone\models\SmileDropZoneModel;

class ImageHelper
{

    public static function buildImgPathThumbnail($arr){
        $date = getdate($arr['date']);
        $fileName =
            SmileDropZoneModel::SEPARATOR.
            'uploads_db'.
            SmileDropZoneModel::SEPARATOR.
            $arr['model'].
            SmileDropZoneModel::SEPARATOR.
            $date['year'].
            SmileDropZoneModel::SEPARATOR.
            $date['mon'].
            SmileDropZoneModel::SEPARATOR.
            $date['mday'].
            SmileDropZoneModel::SEPARATOR.
            $arr['id_item'].
            SmileDropZoneModel::SEPARATOR.
            $arr['id'].
            SmileDropZoneModel::SEPARATOR.
            'thumbnails'.
            SmileDropZoneModel::SEPARATOR.
            SmileDropZoneModel::IMG_MIN_WIDTH.'x'.SmileDropZoneModel::IMG_MIN_HEIGHT.
            SmileDropZoneModel::SEPARATOR.
            $arr['name']
        ;
        return $fileName;
    }

    public static function buildImgPathBig($arr){
        $date = getdate($arr['date']);
        $fileName =
            SmileDropZoneModel::SEPARATOR.
            'uploads_db'.
            SmileDropZoneModel::SEPARATOR.
            $arr['model'].
            SmileDropZoneModel::SEPARATOR.
            $date['year'].
            SmileDropZoneModel::SEPARATOR.
            $date['mon'].
            SmileDropZoneModel::SEPARATOR.
            $date['mday'].
            SmileDropZoneModel::SEPARATOR.
            $arr['id_item'].
            SmileDropZoneModel::SEPARATOR.
            $arr['name']
        ;
        return $fileName;
    }

    public static function buildNewsPhotoPath($name, $id){
        $fileName =
            SmileDropZoneModel::SEPARATOR.
            'uploads'.
            SmileDropZoneModel::SEPARATOR.
            'NewsPhoto'.
            SmileDropZoneModel::SEPARATOR.
            $id.
            SmileDropZoneModel::SEPARATOR.
            $name
        ;
        return $fileName;
    }

}