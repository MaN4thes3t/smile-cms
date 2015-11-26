<?php
namespace backend\smile;

use Yii;
use yii\redactor\RedactorModule;
/**
 * Created by PhpStorm.
 * User: јртЄм
 * Date: 26.11.2015
 * Time: 23:06
 */
class Redactor extends RedactorModule
{
    public function getOwnerPath()
    {
        $date = getdate();
        return $date['year']. DIRECTORY_SEPARATOR . $date['mon'] . DIRECTORY_SEPARATOR . $date['mday'];
    }
}