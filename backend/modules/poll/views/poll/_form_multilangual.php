<?php
/**
 * Created by PhpStorm.
 * User: Kate
 * Date: 10.02.15
 * Time: 15:05
 * @var $model backend\modules\poll\models\PollTranslate
 * @var $form yii\widgets\ActiveForm
 * @var $language string
 * @var $modelAnswer backend\modules\poll\models\Answer
 * @var $answers backend\modules\poll\models\Answer
 */
use backend\modules\poll\models\Answer;
use backend\modules\poll\models\Poll;
use yii\helpers\Html;
use yii\helpers\VarDumper;
use yii\helpers\StringHelper;
use backend\smile\components\SmileHtml;
?>
<?php
$className = StringHelper::basename(get_class($model));
?>
    <?= $form->field($model, 'title')->textInput(array(
        'name' => $className.'['.$language.'][title]',
        'id' => $className.'_'.$language.'_'.'title'
    )); ?>
<div class="answers_container_main">
    <div class="answers_container">
        <?php
        $modelAnswer = new Answer();
        $classNameAnswer = StringHelper::basename(get_class($modelAnswer));
        if(!$model->isNewRecord){
            $b_model = Poll::findOne($model->id_item);
            $answers = $b_model->answers;
            if($answers){
                foreach($answers as $key => $answer){
                    ?>
                    <div class="form-group">
                        <?= SmileHtml::label(Yii::t('backend','Вариант ответа').' '.'('.$answer->count_answers.')',$classNameAnswer.'_new_'.$language.'_title',[
                            'class'=>'control-label'
                        ])?>
                        <?= SmileHtml::textInput($classNameAnswer.'['.$key.']['.$language.'][title]',$answer->translate[$language]->title,[
                            'class'=>'answer_input form-control',
                            'id'=>$classNameAnswer.'['.$key.']['.$language.'][title]'
                        ])?>
                        <div class='remove_answer glyphicon glyphicon-remove'></div>
                    </div>
                    <?php
                }
            }
        }
        ?>
    </div>
    <div class="hidden answer_template">

        <div class="form-group">
            <?= SmileHtml::label(Yii::t('backend','Вариант ответа').' '.'('.Yii::t('backend','Новый вариант').')',$classNameAnswer.'_new_'.$language.'_title',[
                'class'=>'control-label'
            ])?>
            <?= SmileHtml::textInput($classNameAnswer.'[new]['.$language.'][][title]','',[
                'class'=>'answer_input form-control',
                'id'=>$classNameAnswer.'[new]['.$language.'][][title]'
            ])?>
            <div class='remove_answer glyphicon glyphicon-remove'></div>
        </div>

    </div>
    <div class="form-group">
        <?= SmileHtml::button(Yii::t('backend','Добавить новый вариант ответа'),[
            'class'=>'btn btn-primary add_new_answer'
        ])?>
    </div>
</div>
<?= $form->field($model, 'translit')->textInput(array(
    'name' => $className.'['.$language.'][translit]',
    'id' => $className.'_'.$language.'_'.'translit'
)); ?>



