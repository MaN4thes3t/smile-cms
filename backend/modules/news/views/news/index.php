<?php
use backend\smile\components\SmileHtml;
use yii\grid\GridView;
use yii\helpers\StringHelper;
use yii\jui\DatePicker;
use backend\modules\news\models\Type;
use kartik\select2\Select2;
use backend\modules\newscategory\models\Newscategory;
use yii\helpers\ArrayHelper;
use backend\smile\modules\dropzone\models\SmileDropZoneModel;
use \yii\widgets\Pjax;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel backend\modules\news\models\NewsSearch */

$this->title = Yii::t('backend','Новости');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-translate-index">

    <h1><?= SmileHtml::encode($this->title) ?></h1>

    <p>
        <?= SmileHtml::a(Yii::t('backend','Создать новую новость'), ['create'], ['class' => 'btn btn-success']) ?>
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
        'tableOptions'=>[
            'class'=>'table table-striped table-bordered',
        ],
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
                'attribute'=>'title',
                'label'=>Yii::t('backend','Заголовок'),
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

                    return SmileHtml::a($data->t->title?$data->t->title:Yii::t('backend', 'Нет заголовка'), ['update','id'=>$data->id],[
                        'style'=>[
                            'color'=>$data->title_color
                        ]
                    ]).$html;
                },
                'filter'=>SmileHtml::activeTextInput($searchModel,'title',['class'=>'form-control']),
                'format'=>'raw',

            ],
            [
                'attribute'=>'categories',
                'label'=>Yii::t('backend','Категория'),
                'value'=>function($data){
                    if($data->categories) {
                        $html = [];
                        foreach ($data->categories as $category) {
                            $html [] = $category->category->t->name;
                        }
                        return implode(',</br>',$html);
                    }
                },
                'filter'=>Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'categories',
                    'value' => $searchModel->categories,
                    'data' => ArrayHelper::map(Newscategory::find()->with('t')->all(),'id',function($category){
                        return $category->t->name;
                    }),
                    'options' => ['multiple' => true, 'placeholder' => Yii::t('backend','Выберите категорию')]
                ]),
                'format'=>'raw',
                'contentOptions'=>['style'=>[
                    'width'=>'190px'
                ]]
            ],
            [
                'attribute'=>'types',
                'label'=>Yii::t('backend','Типы'),
                'value'=>function($data){
                    if($data->types) {
                        $html = [];
                        foreach ($data->types as $type) {
                            $html[]= Type::getTypes()[$type->type_code];
                        }
                        return implode(',</br>',$html);
                    }
                },
                'filter'=>Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'types',
                    'value' => $searchModel->types,
                    'data' => Type::getTypes(),
                    'options' => ['multiple' => true, 'placeholder' => Yii::t('backend','Выберите типы')]
                ]),
                'format'=>'raw',
                'contentOptions'=>['style'=>[
                    'width'=>'170px'
                ]]
            ],
            [
                'attribute'=>'create_date',
                'value'=>function($data){
                    return date('d.m.Y',$data->create_date);
                },
                'filter'=>
                    Yii::t('backend','От').DatePicker::widget([
                    'language' => 'uk',
                        'dateFormat' => 'dd.MM.yyyy',
                    'value'=>$searchModel->create_date?$searchModel->create_date['from']:'',
                    'name'=>StringHelper::basename(get_class($searchModel)).'[create_date][from]',
                    'options'=>[
                        'class'=>'form-control',
                    ]
                    ]).
                    Yii::t('backend','До').DatePicker::widget([
                        'language' => 'uk',
                        'dateFormat' => 'dd.MM.yyyy',
                        'value'=>$searchModel->create_date?$searchModel->create_date['to']:'',
                        'name'=>StringHelper::basename(get_class($searchModel)).'[create_date][to]',
                        'options'=>[
                            'class'=>'form-control',
                        ]
                    ]),
                'contentOptions'=>['style'=>[
                    'width'=>'10px'
                ]]
            ],
            [
                'attribute'=>'end_date',
                'value'=>function($data){
                    return date('d.m.Y',$data->end_date);
                },
                'filter'=>
                    Yii::t('backend','От').DatePicker::widget([
                        'language' => 'uk',
                        'dateFormat' => 'dd.MM.yyyy',
                        'value'=>$searchModel->end_date?$searchModel->end_date['from']:'',
                        'name'=>StringHelper::basename(get_class($searchModel)).'[end_date][from]',
                        'options'=>[
                            'class'=>'form-control',
                        ]
                    ]).
                    Yii::t('backend','До').DatePicker::widget([
                        'language' => 'uk',
                        'dateFormat' => 'dd.MM.yyyy',
                        'value'=>$searchModel->end_date?$searchModel->end_date['to']:'',
                        'name'=>StringHelper::basename(get_class($searchModel)).'[end_date][to]',
                        'options'=>[
                            'class'=>'form-control',
                        ]
                    ]),
                'contentOptions'=>['style'=>[
                    'width'=>'10px'
                ]]
            ],
            [
                'attribute'=>'views',
                'value'=>function($data){
                    return $data->views;
                },
                'filter'=>
                    Yii::t('backend','От').SmileHtml::textInput(StringHelper::basename(get_class($searchModel)).'[views][from]',$searchModel->views['from']?$searchModel->views['from']:'',[
                    'class'=>'form-control',
                ]).
                    Yii::t('backend','До').SmileHtml::textInput(StringHelper::basename(get_class($searchModel)).'[views][to]',$searchModel->views['to']?$searchModel->views['to']:'',[
                        'class'=>'form-control',
                    ]),
                'contentOptions'=>['style'=>[
                    'width'=>'10px'
                ]]
            ],
            [
                'attribute'=>'comments',
                'value'=>function($data){
                    return $data->comments;
                },
                'filter'=>
                    Yii::t('backend','От').SmileHtml::textInput(StringHelper::basename(get_class($searchModel)).'[comments][from]',$searchModel->comments['from']?$searchModel->comments['from']:'',[
                        'class'=>'form-control',
                    ]).
                    Yii::t('backend','До').SmileHtml::textInput(StringHelper::basename(get_class($searchModel)).'[comments][to]',$searchModel->comments['to']?$searchModel->comments['to']:'',[
                        'class'=>'form-control',
                    ]),
                'contentOptions'=>['style'=>[
                    'width'=>'10px'
                ]]
            ],
            [
                'attribute'=>'show',
                'value'=>function($data){
                    return $data->show==1?Yii::t('backend','Отображать'):Yii::t('backend','Не отображать');
                },
                'filter'=>SmileHtml::activeDropDownList($searchModel,'show',
                    ['1'=>Yii::t('backend','Отображать'),'0'=>Yii::t('backend','Не отображать')],
                    ['prompt'=>Yii::t('backend','Выберите'),'class'=>'form-control']),
                'contentOptions'=>['style'=>[
                    'width'=>'10px'
                ]]
            ],
        ],
    ]); ?>
    <?php Pjax::end();?>
</div>
