<?php
use backend\smile\components\SmileHtml;
use yii\grid\GridView;
use \yii\widgets\Pjax;
use yii\helpers\StringHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel backend\modules\newscategory\models\NewscategorySearch */

$this->title = Yii::t('backend','Категории новостей');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="newscategory-translate-index">

    <h1><?= SmileHtml::encode($this->title) ?></h1>

    <p>
        <?= SmileHtml::a(Yii::t('backend','Создать новую категорию'), ['create'], ['class' => 'btn btn-success']) ?>
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
                'attribute'=>'name',
                'label'=>Yii::t('backend','Название'),
                'value'=>function($data){
                    return SmileHtml::a($data->t->name?$data->t->name:Yii::t('backend', 'Нет названия'),['update','id'=>$data->id]);
                },
                'filter'=>SmileHtml::activeTextInput($searchModel,'name',['class'=>'form-control']),
                'format'=>'raw'
            ],
            [
                'attribute'=>'show',
                'value'=>function($data){
                    return $data->show==1?Yii::t('backend','Отображать'):Yii::t('backend','Не отображать');
                },
                'filter'=>SmileHtml::activeDropDownList($searchModel,'show',
                    ['1'=>Yii::t('backend','Отображать'),'0'=>Yii::t('backend','Не отображать')],
                    ['prompt'=>Yii::t('backend','Выберите'),'class'=>'form-control']),

            ],
            [
                'attribute'=>'show_in_menu',
                'value'=>function($data) {
                    return $data->show_in_menu==1?Yii::t('backend','Отображать'):Yii::t('backend','Не отображать');
                },
                'filter'=>SmileHtml::activeDropDownList($searchModel,'show_in_menu',
                    ['1'=>Yii::t('backend','Отображать'),'0'=>Yii::t('backend','Не отображать')],
                    ['prompt'=>Yii::t('backend','Выберите'),'class'=>'form-control'])
            ],
            [
                'attribute'=>'show_in_left_menu',
                'value'=>function($data){
                    return $data->show==1?Yii::t('backend','Отображать'):Yii::t('backend','Не отображать');
                },
                'filter'=>SmileHtml::activeDropDownList($searchModel,'show_in_left_menu',
                    ['1'=>Yii::t('backend','Отображать'),'0'=>Yii::t('backend','Не отображать')],
                    ['prompt'=>Yii::t('backend','Выберите'),'class'=>'form-control'])
            ],
        ],
    ]); ?>
    <?php Pjax::end();?>
</div>
