<?php

use backend\smile\components\SmileHtml;
use yii\widgets\ActiveForm;
use yii\bootstrap\Tabs;
use yii\helpers\Url;
use yii\jui\DatePicker;
use backend\smile\widget\SmileDropZOne;

/* @var $this yii\web\View */
/* @var $model backend\modules\leader\models\Leader */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="leader-form span6">

    <?php $form = ActiveForm::begin(); ?>
    <?=$form->field($model, 'birthday',[
        'template'=>'{label}'
    ]) ?>
    <?= DatePicker::widget([
        'model' => $model,
        'attribute' => 'birthday',
        'language' => 'en-AU',
        'options' =>[
            'class'=>'form-control'
        ],
    ]); ?>
    <?= $form->field($model, 'show')->checkbox(); ?>


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
    <?php
    echo SmileDropZOne::widget([
        'model'=>$model,
    ]);
    ?>
    </div>
    <div class="form-group">
        <?= SmileHtml::submitButton($model->isNewRecord ? Yii::t('backend','Создать') : Yii::t('backend','Сохранить'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
