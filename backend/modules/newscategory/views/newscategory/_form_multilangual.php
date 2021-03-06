<?php
/**
 * Created by PhpStorm.
 * User: Kate
 * Date: 10.02.15
 * Time: 15:05
 * @var $model backend\modules\newscategory\models\newscategoryTranslate
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
    <?= $form->field($model, 'name')->textInput(array(
        'name' => $className.'['.$language.'][name]',
        'id' => $className.'_'.$language.'_'.'name'
    )); ?>
    <?= $form->field($model, 'seotitle')->textInput(array(
        'name' => $className.'['.$language.'][seotitle]',
        'id' => $className.'_'.$language.'_'.'seotitle'
    )); ?>
    <?= $form->field($model, 'seokeywords')->textarea(array(
        'name' => $className.'['.$language.'][seokeywords]',
        'id' => $className.'_'.$language.'_'.'seokeywords'
    )); ?>
    <?= $form->field($model, 'seodescription')->textarea(array(
        'name' => $className.'['.$language.'][seodescription]',
        'id' => $className.'_'.$language.'_'.'seodescription'
    )); ?>


