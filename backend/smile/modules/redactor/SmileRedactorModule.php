<?php
namespace backend\smile\modules\redactor;

use Yii;
use yii\helpers\VarDumper;
use yii\redactor\RedactorModule;
/**
 * Created by PhpStorm.
 * User: Àðò¸ì
 * Date: 26.11.2015
 * Time: 23:06
 */
class SmileRedactorModule extends RedactorModule
{
    public $controllerNamespace = 'backend\smile\modules\redactor\controllers';

    public $imageUploadRoute = ['/redactor/smile-upload/image'];
    public $fileUploadRoute = ['/redactor/smile-upload/file'];

    public function getOwnerPath()
    {
        $date = getdate();
        $moduleName = Yii::$app->session->get('redactorModuleName')?Yii::$app->session->get('redactorModuleName'). DIRECTORY_SEPARATOR : '';
//        Yii::$app->session->remove('redactorModuleName');
        return $moduleName.$date['year']. DIRECTORY_SEPARATOR . $date['mon'] . DIRECTORY_SEPARATOR . $date['mday'];
    }
}