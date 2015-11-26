<?php
/**
 * Created by PhpStorm.
 * User: Kate
 * Date: 10.02.15
 * Time: 15:05
 * @var $model backend\modules\language\models\languageTranslate
 * @var $form yii\widgets\ActiveForm
 * @var $language string
 */
use backend\smile\components\SmileHtml;
use yii\helpers\VarDumper;
use yii\helpers\StringHelper;
?>
<?php
$className = StringHelper::basename(get_class($model));
?>
    <?= $form->field($model, 'translate')->textInput(array(
            'name' => $className.'['.$language.'][translate]',
            'id' => $className.'_'.$language.'_'.'translate'
        )); ?>
    <?= $form->field($model, 'description')->textarea(array(
        'name' => $className.'['.$language.'][description]',
        'id' => $className.'_'.$language.'_'.'description'
    )); ?>