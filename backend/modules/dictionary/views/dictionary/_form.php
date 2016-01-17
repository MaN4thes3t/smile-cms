<?php

use backend\smile\components\SmileHtml;
use yii\widgets\ActiveForm;
use yii\bootstrap\Tabs;

/* @var $this yii\web\View */
/* @var $model backend\modules\dictionary\models\Dictionary */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dictionary-form span6">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'message')->textarea(); ?>
    <?= $form->field($model, 'category', [
        'template' => "{label}\n{input}\n{hint}\n{error}"
    ])->dropDownList(SmileHtml::enumItem($model, 'category'))?>
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

    <?php echo Tabs::widget([
        'items' => $items,
    ]);?>

    <div class="form-group">
        <?= SmileHtml::submitButton($model->isNewRecord ? Yii::t('backend','Создать') : Yii::t('backend','Сохранить'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= SmileHtml::submitButton(Yii::t('backend','Сохранить и редактировать'), ['class' => 'btn btn-info','name'=>'edit','value'=>'1']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
