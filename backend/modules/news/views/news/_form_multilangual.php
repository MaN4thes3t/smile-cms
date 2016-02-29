<?php
/**
 * Created by PhpStorm.
 * User: Kate
 * Date: 10.02.15
 * Time: 15:05
 * @var $model backend\modules\news\models\newsTranslate
 * @var $form yii\widgets\ActiveForm
 * @var $language string
 */
use yii\helpers\Html;
use yii\helpers\VarDumper;
use yii\helpers\StringHelper;
use yii\redactor\widgets\Redactor;
?>
<?php
$className = StringHelper::basename(get_class($model));
//VarDumper::dump($model,6,1);
?>
    <div class="types_fields point_of_view the_word_public interview">
<?= $form->field($model, 'first_name')->textInput(array(
    'name' => $className.'['.$language.'][first_name]',
    'id' => $className.'_'.$language.'_'.'first_name'
)); ?>
    </div>
    <div class="types_fields point_of_view the_word_public interview">
<?= $form->field($model, 'second_name')->textInput(array(
    'name' => $className.'['.$language.'][second_name]',
    'id' => $className.'_'.$language.'_'.'second_name'
)); ?>
    </div>
    <div class="types_fields point_of_view">
<?= $form->field($model, 'annotation')->textInput(array(
    'name' => $className.'['.$language.'][annotation]',
    'id' => $className.'_'.$language.'_'.'annotation'
)); ?>
    </div>
    <?= $form->field($model, 'title')->textInput(array(
        'name' => $className.'['.$language.'][title]',
        'id' => $className.'_'.$language.'_'.'title'
    )); ?>
    <?= $form->field($model, 'short_description')->textarea(array(
        'name' => $className.'['.$language.'][short_description]',
        'id' => $className.'_'.$language.'_'.'short_description'
    )); ?>
    <?= $form->field($model, 'description')->widget(Redactor::className(), [
        'options' => [
            'name' => $className.'['.$language.'][description]',
            'id' => $className.'_'.$language.'_'.'description'
        ],
        'clientOptions' => [
            'minHeight'=>300,
            'placeholder'=>'Enter your text here...',
            'plugins' => [
                'textdirection',
                'fontsize',
                'fontfamily',
                'fontcolor',
                'table',
                'video',
//                'counter',
                'fullscreen',
//                'definedlinks',
//                'limiter',
//                'textpander'
            ],
            'lang'=>Yii::$app->language,
            'buttons'=>[
                'alignment',
                'bold',
                'italic',
                'underline',
                'deleted',
                'horizontalrule',
                'unorderedlist',
                'image',
                'link',
                'indent',
                'outdent',
            ],
        ],
    ])?>
    <?php
    Yii::$app->session->set('redactorModuleName',$className);
    ?>
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

