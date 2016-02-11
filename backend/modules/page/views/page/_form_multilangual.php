<?php
/**
 * Created by PhpStorm.
 * User: Kate
 * Date: 10.02.15
 * Time: 15:05
 * @var $model backend\modules\page\models\pageTranslate
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
?>
    <?= $form->field($model, 'title')->textInput(array(
        'name' => $className.'['.$language.'][title]',
        'id' => $className.'_'.$language.'_'.'title'
    )); ?>
<?php if(!$model->isNewRecord){
    ?>
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
                'alignment',/*выравнивание*/
                'bold',/*жирный*/
                'italic',/*наклонный*/
                'underline',/*подчеркнутый*/
                'deleted',/*зачеркнутый*/
                'horizontalrule',/*горизонтальная линия*/
                'unorderedlist',/*список*/
                'image',/*картинки*/
                'link',/*вставить ссылку*/
                'indent',/*отступ увеличить*/
                'outdent',/*отсуп уменьшить*/
            ],
        ],
    ])?>
    <?php
    Yii::$app->session->set('redactorModuleName',$className);
    Yii::$app->session->set('redactorModuleNameId',$model->id);
    ?>
    <?php
}?>
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

