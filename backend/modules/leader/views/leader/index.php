<?php
use backend\smile\components\SmileHtml;
use yii\grid\GridView;

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
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            /* @var yii\grid\SerialColumn */
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute'=>'name',
                'label'=>Yii::t('backend','Имя, фамилия'),
                'value'=>function($data) use ($model){
                    return $data->t->first_name.' '.$data->t->last_name;
                },
                'filter'=>SmileHtml::activeTextInput($searchModel,'name',['class'=>'form-control']),
                'format'=>'raw'
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
