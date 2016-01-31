<?php

use backend\smile\components\SmileHtml;
use yii\grid\GridView;
use \yii\widgets\Pjax;
use yii\helpers\StringHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel backend\modules\dictionary\models\DictionarySearch */

$this->title = Yii::t('backend','Словарь переводов');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dictionary-translate-index">

    <h1><?= SmileHtml::encode($this->title) ?></h1>

    <p>
        <?= SmileHtml::a(Yii::t('backend','Создать новый перевод'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= SmileHtml::button(Yii::t('frontend', 'Выбранные') . ':',['id'=>'mass_action_submit','class'=>'btn btn-primary']);?>
        <?= SmileHtml::dropDownList('mass_action_actions','delete',
            [Url::toRoute(['delete'])=>Yii::t('backend','Удалить')],
            [
                'style'=>[
                    'border-color'=>'black'
                ],
                'class'=>'btn select-auto',
                'id'=>'mass_action_actions',
                'prompt'=>Yii::t('backend','Выберите')
            ])?>
        <script type="text/javascript">
            $(document).ready(function(){
                Smile.Grid.init();
            });
        </script>
    </p>
    <?php Pjax::begin(['options' => ['class' => 'pjax-wraper','id'=>'pjax-mass-action'],'linkSelector'=>false]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute'=>'id',
                'value'=>function($data){
                    return
                        SmileHtml::label($data->id,'for_change_'.$data->id).' '.
                        SmileHtml::checkbox(StringHelper::basename(get_class($data)),false,[
                            'id'=>'for_change_'.$data->id,
                            'value'=>$data->id,
                            'class'=>'mass_action_checkbox'
                        ]);
                },
                'format'=>'raw',
                'filter'=>SmileHtml::activeTextInput($searchModel,'id',['class'=>'form-control']),
                'contentOptions'=>['style'=>[
                    'width'=>'80px'
                ]]
            ],
            [
                'attribute'=>'message',
                'value'=>function($data){
                    return SmileHtml::a($data->message,['update','id'=>$data->id]);
                },
                'format'=>'raw',
            ],
            [
                'attribute'=>'category',
                'filter'=>SmileHtml::activeEnumDropDownList($searchModel, 'category', ['class'=>'form-control',
                    'prompt'=>Yii::t('backend','Выберите')
                ])
            ],

        ],
    ]); ?>
    <?php Pjax::end();?>
</div>
