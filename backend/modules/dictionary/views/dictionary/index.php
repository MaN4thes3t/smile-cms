<?php

use backend\smile\components\SmileHtml;
use yii\grid\GridView;

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
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            /* @var yii\grid\SerialColumn */
            ['class' => 'yii\grid\SerialColumn'],
//            'id',
            [
                'attribute'=>'category',
                'filter'=>SmileHtml::activeEnumDropDownList($searchModel, 'category', ['class'=>'form-control',
                    'prompt'=>Yii::t('backend','Выберите')
                ])
            ],
            [
                'attribute'=>'message',
            ],
            [
                /* @var $dataProvider yii\grid\ActionColumn */
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{update}{delete}',
            ],
        ],
    ]); ?>

</div>
