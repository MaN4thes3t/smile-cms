<?php
use backend\smile\components\SmileHtml;
use yii\grid\GridView;
use \yii\widgets\Pjax;
use yii\helpers\StringHelper;
use yii\helpers\Url;
use yii\jui\DatePicker;
use backend\smile\modules\dropzone\models\SmileDropZoneModel;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel backend\modules\leader\models\LeaderSearch */

$this->title = Yii::t('backend','Лидеры');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="leader-translate-index">

    <h1><?= SmileHtml::encode($this->title) ?></h1>

    <p>
        <?= SmileHtml::a(Yii::t('backend','Создать нового лидера'), ['create'], ['class' => 'btn btn-success']) ?>
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
                'label'=>Yii::t('backend','Имя, фамилия'),
                'value'=>function($data) {
                    return SmileHtml::a($data->t->first_name.' '.$data->t->last_name,['update','id'=>$data->id]) ;
                },
                'filter'=>SmileHtml::activeTextInput($searchModel,'name',['class'=>'form-control']),
                'format'=>'raw'
            ],
            [
                'header'=>Yii::t('backend','Фото'),
                'value'=>function($data) use($dataProvider){
                    $html = '</br>';
                    $model = new SmileDropZoneModel();
                    $model->initFields($data->id,get_class($data));
                    foreach ($model->loadImages() as $image) {
                        $html.= SmileHtml::img($image['thumbnailUrl'],[
                            'style'=>[
                                'max-width'=>'56px',
                                'max-height'=>'56px',
                                'margin'=>'5px',
                                'border'=>'1px',
                                'float'=>'left'
                            ],
                        ]);
                    }
                    return $html;
                },
                'format'=>'raw'
            ],
            [
                'attribute'=>'birthday',
                'value'=>function($data){
                    return date('d.m.Y',$data->birthday);
                },
                'filter'=>
                    Yii::t('backend','От').DatePicker::widget([
                        'language' => 'uk',
                        'dateFormat' => 'dd.MM.yyyy',
                        'value'=>$searchModel->birthday?$searchModel->birthday['from']:'',
                        'name'=>StringHelper::basename(get_class($searchModel)).'[birthday][from]',
                        'options'=>[
                            'class'=>'form-control',
                        ]
                    ]).
                    Yii::t('backend','До').DatePicker::widget([
                        'language' => 'uk',
                        'dateFormat' => 'dd.MM.yyyy',
                        'value'=>$searchModel->birthday?$searchModel->birthday['to']:'',
                        'name'=>StringHelper::basename(get_class($searchModel)).'[birthday][to]',
                        'options'=>[
                            'class'=>'form-control',
                        ]
                    ]),
                'contentOptions'=>['style'=>[
                    'width'=>'10px'
                ]]
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
