<?php

use backend\smile\components\SmileHtml;
use yii\widgets\ActiveForm;
use yii\bootstrap\Tabs;
use yii\jui\DatePicker;
use yii\helpers\Json;

/* @var $this yii\web\View */
/* @var $model backend\modules\poll\models\Poll */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="poll-form span6">

    <?php $form = ActiveForm::begin([
        'enableClientValidation' => false,
        'options'=>[
            'id'=>'poll_form',
        ]
    ]); ?>

    <?= $form->field($model, 'show')->checkbox(); ?>
    <?= $form->field($model, 'translit')->textInput(); ?>
    <?= $form->field($model, 'my_version')->checkbox([
        'class'=>'my_version_checkbox'
    ]); ?>
    <?php if(!$model->isNewRecord){
        ?>
        <?= $form->field($model, 'my_version_text',[
            'template' => "{input}"
        ])->hiddenInput()?>
        <?php
        $versions = $model->my_version_text?Json::decode($model->my_version_text):[];
        ?>
        <div class="my_answers_container" <?php if(!$versions || !$model->my_version){?> style="display:none;" <?php }?>>
            <?= SmileHtml::label(Yii::t('backend','Варианты ответов людей').' '.'('.$model->my_version_count.')','',[
            'class'=>'control-label'
        ])?>
        <?php
        foreach($versions as $key=>$version){
            ?>
            <div class="form-group">
                <?= SmileHtml::textInput('my_version'.'['.$key.']',$version,[
                    'class'=>'my_answer_input form-control',
                    'id'=>'my_version'.'['.$key.']'
                ])?>
                <div class='remove_my_answer glyphicon glyphicon-remove'></div>
            </div>
            <?php
        }
        ?>
        </div>
            <?php
    }?>


    <?php
    ?>
    <?= $form->field($model, 'type')->dropDownList($model::$POLL_TYPES); ?>


    <?php foreach (Yii::$app->params['languages'] as $lang=>$info): ?>
        <?php
        $tab = [
            'label' => $info['name'],
            'content' => $this->context->renderPartial('_form_multilangual', [
                'form' => $form,
                'model'=> $model->translateModels[$lang],
                'language' => $lang,
            ]),
            'active' => $lang == Yii::$app->language
        ];
        $items[] = $tab;
        ?>
    <?php endforeach; ?>
    <script type="text/javascript">
        $(document).ready(function(){
            Smile.Poll.init();
        });
    </script>
    <?php echo Tabs::widget([
        'items' => $items,
    ]);?>

    <div class="form-group">
        <?= SmileHtml::submitButton($model->isNewRecord ? Yii::t('backend','Создать') : Yii::t('backend','Сохранить'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= SmileHtml::submitButton(Yii::t('backend','Сохранить и редактировать'), ['class' => 'btn btn-info','name'=>'edit','value'=>'1']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
