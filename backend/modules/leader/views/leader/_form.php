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

    <?php $form = ActiveForm::begin([
        'enableClientValidation' => false,
    ]); ?>
    <div class="form-group">
        <?= SmileHtml::label(Yii::t('backend','День рождения'))?>
        <?= DatePicker::widget([
            'model' => $model,
            'attribute' => 'birthday',
            'language' => 'uk',
            'dateFormat' => 'dd.MM.yyyy',
            'options' =>[
                'class'=>'form-control'
            ],
        ]); ?>
    </div>

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
    <?php
    $arr_image_params = [
        'name'=>'images[]',
        'gallery'=>false,
        'id'=>'images-upload',
        'modelClass'=>get_class($model),
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
        ]
    ];
    if($model->isNewRecord){
        ?>
        <?=SmileHtml::hiddenInput('new_image_hash',!empty($new_image_hash)?$new_image_hash:md5(time()),[
            'id'=>'new_image_hash'
        ])?>
        <?php
        $arr_image_params['clientEvents']['fileuploadalways'] = 'function(e, data) {
                                    Smile.Image.initNewImages();
                                }';
        $arr_image_params['hash'] = !empty($new_image_hash)?$new_image_hash:md5(time());
        $arr_image_params['url'] = ['/dropzone/drop-zone/upload-new', 'hash' => !empty($new_image_hash)?$new_image_hash:md5(time()), 'class'=>get_class($model)];
    }else{
        $arr_image_params['idItem'] = $model->id;
        $arr_image_params['clientEvents']['fileuploadalways'] = 'function(e, data) {
                                    Smile.Image.init();
                                }';
        $arr_image_params['url'] = ['/dropzone/drop-zone/upload', 'id' => $model->id, 'class'=>get_class($model)];
    }?>
    <div class="form-group">
        <?= FileUploadUI::widget($arr_image_params);
        ?>
    </div>
    <?php if(!$model->isNewRecord){
        ?>
        <script type="text/javascript">
            $(document).ready(function(){
                Smile.Image.init();
            })
        </script>
        <?php
    }?>
    <div class="form-group">
        <?= SmileHtml::submitButton($model->isNewRecord ? Yii::t('backend','Создать') : Yii::t('backend','Сохранить'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= SmileHtml::submitButton(Yii::t('backend','Сохранить и редактировать'), ['class' => 'btn btn-info','name'=>'edit','value'=>'1']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>

