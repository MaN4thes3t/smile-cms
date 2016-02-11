<?php

use backend\smile\components\SmileHtml;
use yii\widgets\ActiveForm;
use yii\bootstrap\Tabs;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\modules\poll\models\Poll */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="poll-form span6">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'show')->checkbox(); ?>
    <?= $form->field($model, 'my_version')->checkbox(); ?>
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
