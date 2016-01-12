<?php

use backend\smile\components\SmileHtml;
use yii\widgets\ActiveForm;
use yii\bootstrap\Tabs;
use yii\helpers\Url;
use yii\jui\DatePicker;
use backend\smile\modules\dropzone\widgets\FileUploadUI;

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
    <?php if(!$model->isNewRecord){
        ?>
        <div class="form-group">

        </div>
        <div class="form-group">
            <?= FileUploadUI::widget([
                'name'=>'images[]',
                'gallery'=>false,
                'id'=>'images-upload',
                'idItem'=>$model->id,
                'modelClass'=>get_class($model),
                'url' => ['/dropzone/drop-zone/upload', 'id' => $model->id, 'class'=>get_class($model)],
                'fieldOptions' => [
                    'accept' => 'image/*',
                    'fileTypes'=>'png',
                ],
                'clientOptions' => [
                    'maxFileSize' => 5000000,
                    'autoUpload'=>true,
                    'fileTypes'=>'png',
                    'multipart'=>true,
                    'forceIframeTransport'=>false,
                    'singleFileUploads'=>false,
                ],
                'clientEvents'=>[
                    'fileuploadalways'=>'function(e, data) {
                                    Smile.Image.init();
                                }',
                ]
            ]);
            ?>
        </div>
        <script type="text/javascript">
            $(document).ready(function(){
                Smile.Image.init();
            })
        </script>
        <?php
    }?>
    <div class="form-group">
        <?= SmileHtml::submitButton($model->isNewRecord ? Yii::t('backend','Создать') : Yii::t('backend','Сохранить'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>

