<?php

use backend\smile\components\SmileHtml;
use yii\widgets\ActiveForm;
use yii\bootstrap\Tabs;
use yii\helpers\Url;
use backend\smile\modules\dropzone\widgets\FileUploadUI;
use backend\modules\tag\models\Tag;
use backend\modules\source\models\Source;
use backend\modules\newscategory\models\Newscategory;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\color\ColorInput;
use dosamigos\datetimepicker\DateTimePicker;
/* @var $this yii\web\View */
/* @var $model backend\modules\news\models\News */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="news-form span6">

    <?php $form = ActiveForm::begin([
        'enableClientValidation' => false,
        'options' => [
            'enctype' => 'multipart/form-data'
        ]
    ]); ?>
    <?php
    echo $form->field($model, 'title_color')->widget(ColorInput::classname(), [
        'options' => ['placeholder' => Yii::t('backend','Выберите цвет заголовка')],
    ]);
    ?>
    <div class="form-group">
    <?= SmileHtml::label(Yii::t('frontend','Выберите типы'))?>
    <?= Select2::widget([
        'name' => 'Type',
        'value' => ArrayHelper::map($model->types, 'type_code', 'type_code'),
        'data' =>backend\modules\news\models\Type::getTypes(),
        'options' => ['multiple' => true, 'placeholder' => Yii::t('backend','Выберите типы'),'class'=>'news_change_type']
    ]);?>
    </div>
    <div class="form-group">
    <?= SmileHtml::label(Yii::t('frontend','Выберите категории'))?>
    <?= Select2::widget([
        'name' => 'Category',
        'value' => ArrayHelper::map($model->categories,'id_category', 'id_category'),
        'data' =>
            ArrayHelper::map(Newscategory::find()->with('t')->all(),'id',function($category){
                return $category->t->name;
            }),
        'options' => ['multiple' => true, 'placeholder' => Yii::t('backend','Выберите категории')]
    ]);?>
    </div>
    <div class="form-group">
    <?= SmileHtml::label(Yii::t('frontend','Выберите теги'))?>
    <?= Select2::widget([
        'name' => 'Tag',
        'value' => ArrayHelper::map($model->tags,'id_tag', 'id_tag'),
        'data' =>
            ArrayHelper::map(Tag::find()->where(['show'=>1])->with('t')->all(),'id',function($tag){
                return $tag->t->text;
            }),
        'options' => ['multiple' => true, 'placeholder' => Yii::t('backend','Выберите теги')]
    ]);?>
    </div>
    <div class="form-group">
        <?= SmileHtml::label(Yii::t('frontend','Выберите источник'))?>
        <?= Select2::widget([
            'name' => 'Source',
            'value' => $model->source->id,
            'data' =>
                ArrayHelper::map(Source::find()->where(['show'=>1])->with('t')->all(),'id',function($source){
                    return $source->t->name;
                }),
            'options' => ['multiple' => false, 'placeholder' => Yii::t('backend','Выберите источник')]
        ]);?>
    </div>
    <div class="form-group">
        <?= SmileHtml::label(Yii::t('backend','Дата создания'))?>
        <?php
        if($model->create_date)
        $model->create_date = date('d.m.Y H:i', $model->create_date);?>
        <?= DateTimePicker::widget([
            'model' => $model,
            'attribute' => 'create_date',
            'language' => 'uk',
            'template' => '{button}{input}{reset}',
            'clientOptions' =>[
                'autoclose' => true,
                'class'=>'form-control',
                'format' => 'dd.mm.yyyy HH:ii',
            ],
        ]); ?>
    </div>

    <div class="form-group">
        <?= SmileHtml::label(Yii::t('backend','Дата окончания'))?>
        <?php
        if($model->end_date)
        $model->end_date = date('d.m.Y H:i', $model->end_date);?>
        <?= DateTimePicker::widget([
            'model' => $model,
            'attribute' => 'end_date',
            'language' => 'uk',
            'template' => '{button}{input}{reset}',
            'clientOptions' =>[
                'autoclose' => true,
                'class'=>'form-control',
                'format' => 'dd.mm.yyyy HH:ii',
            ],
        ]); ?>
    </div>
    <div class="types_fields poster">
    <div class="form-group">
        <?= SmileHtml::label(Yii::t('backend','Дата события (если тип "Афиша")'))?>
        <?php
        if($model->event_date)
        $model->event_date = date('d.m.Y H:i', $model->event_date);?>
        <?= DateTimePicker::widget([
            'model' => $model,
            'attribute' => 'event_date',
            'language' => 'uk',
            'template' => '{button}{input}{reset}',
            'clientOptions' =>[
                'autoclose' => true,
                'class'=>'form-control',
                'format' => 'dd.mm.yyyy HH:ii',
            ],
        ]); ?>
    </div>
    </div>
    <div class="types_fields point_of_view the_word_public interview">
    <?php if($model->photo){
        ?>
        <div class="form-group">
            <div class="news_photo_container">
                <img style="max-width:256px;max-height: 256px;" src="<?=DIRECTORY_SEPARATOR?>uploads<?=DIRECTORY_SEPARATOR?>NewsPhoto<?=DIRECTORY_SEPARATOR?><?=$model->id?><?=DIRECTORY_SEPARATOR?><?=$model->photo?>"/>
                <span style="cursor:pointer;" onclick="$('#news_photo_deleted').val($(this).prev().attr('src'));$(this).closest('.news_photo_container').remove()" class="glyphicon glyphicon-remove"></span>
            </div>
            <input type="hidden" value="0" name="photo_deleted" id="news_photo_deleted">
        </div>
        <?php
    }?>
    <?= $form->field($model, 'photo')->fileInput() ?>
    </div>
    <div class="types_fields point_of_view">
        <?php
        echo $form->field($model, 'color')->widget(ColorInput::classname(), [
            'options' => ['placeholder' => Yii::t('backend','Выберите цвет')],
        ]);
        ?>
    </div>
    <?= $form->field($model, 'show')->checkbox(); ?>
    <?= $form->field($model, 'translit')->textInput(); ?>
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
    <script type="text/javascript">
        $(document).ready(function(){
            Smile.News.init();
        })
    </script>
    <?php ActiveForm::end(); ?>
</div>

