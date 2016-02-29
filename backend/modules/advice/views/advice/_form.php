<?php

use backend\smile\components\SmileHtml;
use yii\widgets\ActiveForm;
use yii\bootstrap\Tabs;
use yii\jui\DatePicker;
use backend\modules\tag\models\Tag;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model backend\modules\advice\models\Advice */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="advice-form span6">

    <?php $form = ActiveForm::begin([
        'enableClientValidation' => false,
    ]); ?>

    <?= $form->field($model, 'show')->checkbox(); ?>
    <div class="form-group">
        <?= SmileHtml::label(Yii::t('frontend','Выберите теги'))?>
        <?= Select2::widget([
            'name' => 'Tag',
            'value' => ArrayHelper::map($model->tags,'id_tag', 'id_tag'),
            'data' =>
                ArrayHelper::map(Tag::find()->with('t')->all(),'id',function($tag){
                    return $tag->t->text;
                }),
            'options' => ['multiple' => true, 'placeholder' => Yii::t('backend','Выберите теги')]
        ]);?>
    </div>

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
