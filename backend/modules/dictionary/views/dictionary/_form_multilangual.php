<?php
/**
 * Created by PhpStorm.
 * User: Kate
 * Date: 10.02.15
 * Time: 15:05
 * @var $model backend\modules\dictionary\models\dictionaryTranslate
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
    <?= $form->field($model, 'translation')->textarea(array(
            'name' => $className.'['.$language.'][translation]',
            'id' => $className.'_'.$language.'_'.'translation'
        )); ?>