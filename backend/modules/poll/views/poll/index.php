<?php
use backend\smile\components\SmileHtml;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel backend\modules\poll\models\PollSearch */

$this->title = Yii::t('backend','Опросы');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="poll-translate-index">

    <h1><?= SmileHtml::encode($this->title) ?></h1>

    <p>
        <?= SmileHtml::a(Yii::t('backend','Создать новый опрос'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            /* @var yii\grid\SerialColumn */
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute'=>'title',
                'label'=>Yii::t('backend','Заголовок'),
                'value'=>function($data) use ($model){
                    return $data->t->title;
                },
                'filter'=>SmileHtml::activeTextInput($searchModel,'title',['class'=>'form-control']),
            ],
            [
                'attribute'=>'type',
                'value'=>function($data) use ($model){
                    return backend\modules\poll\models\Poll::$POLL_TYPES[$data->type];
                },
                'filter'=>SmileHtml::activeDropDownList($searchModel,'type',backend\modules\poll\models\Poll::$POLL_TYPES,
                    [
                        'prompt'=>Yii::t('backend','Выберите'),
                        'class'=>'form-control'
                    ])
            ],
            [
                'attribute'=>'show',
                'value'=>function($data) use ($model){
                    return $data->show==1?Yii::t('backend','Отображать'):Yii::t('backend','Не отображать');
                },
                'filter'=>SmileHtml::activeDropDownList($searchModel,'show',
                    ['1'=>Yii::t('backend','Отображать'),'0'=>Yii::t('backend','Не отображать')],
                    ['prompt'=>Yii::t('backend','Выберите'),'class'=>'form-control'])
            ],
            [
                /* @var $dataProvider yii\grid\ActionColumn */
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{update}{delete}',
            ],
        ],
    ]); ?>

</div>
