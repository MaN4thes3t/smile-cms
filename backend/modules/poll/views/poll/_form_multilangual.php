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
use backend\modules\poll\models\PollTranslate;
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
        $b_model = PollTranslate::findOne($model->id);
        $answers = $b_model->answers;
        if($answers){
            foreach($answers as $key => $answer){
                $classNameAnswer = StringHelper::basename(get_class($answer));
                ?>
                <?= $form->field($answer, 'title',[
                    'template'=>"{label} (".$answer->count_answers.")\n{input}\n<div class='remove_answer glyphicon glyphicon-remove'></div>\n{hint}\n{error}"
                ])->textInput([
                    'name' => $className.'['.$language.']['.$classNameAnswer.']['.$key.'][title]',
                    'id' => $className.'_'.$language.'_'.$classNameAnswer.'_'.$key.'_title',
                ])?>
                <?php
            }
        }
        ?>
    </div>
    <div class="hidden answer_template">
        <?php
        $modelAnswer = new Answer();
        $classNameAnswer = StringHelper::basename(get_class($modelAnswer));
        ?>
        <?= $form->field($modelAnswer, 'title',[
            'template'=>"{label} (".Yii::t('backend','Новый вариант').")\n{input}\n<div class='remove_answer glyphicon glyphicon-remove'></div>\n{hint}\n{error}"
        ])->textInput([
            'name' => $className.'['.$language.']['.$classNameAnswer.'][new][][title]',
            'id' => $className.'_'.$language.'_'.$classNameAnswer.'_new_title',
        ])?>
    </div>
    <div class="form-group">
        <?= SmileHtml::button(Yii::t('backend','Добавить новый вариант ответа'),[
            'class'=>'btn btn-primary add_new_answer'
        ])?>
    </div>
</div>



