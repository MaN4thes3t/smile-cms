<?php
use backend\smile\components\SmileHtml;
use yii\grid\GridView;

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
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            /* @var yii\grid\SerialColumn */
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute'=>'name',
                'label'=>Yii::t('backend','Название'),
                'value'=>function($data) use ($model){
                    return $data->t->name;
                },
                'filter'=>SmileHtml::activeTextInput($searchModel,'name',['class'=>'form-control']),
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
