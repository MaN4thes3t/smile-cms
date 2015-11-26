<?php

use backend\smile\components\SmileHtml;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel backend\modules\language\models\LanguageSearch */

$this->title = Yii::t('backend','Языки');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dictionary-translate-index">

    <h1><?= SmileHtml::encode($this->title) ?></h1>

    <p>
        <?= SmileHtml::a(Yii::t('backend','Создать новый язык'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            /* @var yii\grid\SerialColumn */
            ['class' => 'yii\grid\SerialColumn'],
//            'id',
            'code',
            [
                'attribute'=>'name',
                'value'=>function($data){
                    return SmileHtml::a($data->t->translate,['update','id'=>$data->id]);
                },
                'filter'=>SmileHtml::activeTextInput($searchModel,'translate',['class'=>'form-control']),
                'format'=>'raw'
            ],
            [
                'attribute'=>'is_default',
                'value'=>function($data) use ($model){
                    return $data->is_default==1?Yii::t('backend','По-умолчанию'):'';
                },
                'filter'=>SmileHtml::activeDropDownList($searchModel,'is_default',
                    ['1'=>Yii::t('backend','По-умолчанию'),'0'=>Yii::t('backend','Не по-умолчанию')],
                    ['prompt'=>Yii::t('backend','Выберите'),'class'=>'form-control'])
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
