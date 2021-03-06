<?php
use backend\smile\components\SmileHtml;
use yii\grid\GridView;
use \yii\widgets\Pjax;
use yii\helpers\StringHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel backend\modules\tag\models\TagSearch */

$this->title = Yii::t('backend','Теги');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tag-translate-index">

    <h1><?= SmileHtml::encode($this->title) ?></h1>

    <p>
        <?= SmileHtml::a(Yii::t('backend','Создать новый тег'), ['create'], ['class' => 'btn btn-success']) ?>
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
                'attribute'=>'text',
                'label'=>Yii::t('backend','Тег'),
                'value'=>function($data) {
                    $output = '';
                    foreach(Yii::$app->params['languages'] as $key=>$lang){
                        $output .= $key.': '.$data->translate[$key]->text.'<br/>';
                    }
                    return SmileHtml::a($output,['update','id'=>$data->id]);
                },
                'filter'=>SmileHtml::activeTextInput($searchModel,'text',['class'=>'form-control']),
                'format'=>'raw'
            ],
            [
                'attribute'=>'show',
                'value'=>function($data) {
                    return $data->show==1?Yii::t('backend','Отображать'):Yii::t('backend','Не отображать');
                },
                'filter'=>SmileHtml::activeDropDownList($searchModel,'show',
                    ['1'=>Yii::t('backend','Отображать'),'0'=>Yii::t('backend','Не отображать')],
                    ['prompt'=>Yii::t('backend','Выберите'),'class'=>'form-control'])
            ],

        ],
    ]); ?>
    <?php Pjax::end();?>
</div>
