<?php
/**
 * Created by PhpStorm.
 * User: Kate
 * Date: 10.02.15
 * Time: 15:05
 * @var $model backend\modules\tag\models\tagTranslate
 * @var $form yii\widgets\ActiveForm
 * @var $language string
 */
use yii\helpers\Html;
use yii\helpers\VarDumper;
use yii\helpers\StringHelper;
?>
<?php
$className = StringHelper::basename(get_class($model));
?>
    <?= $form->field($model, 'text')->textInput(array(
            'name' => $className.'['.$language.'][text]',
            'id' => $className.'_'.$language.'_'.'text'
        )); ?>