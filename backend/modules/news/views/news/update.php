<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\news\models\News */

$this->title = Yii::t('backend','Редактирование новости') . ': ' . $model->t->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend','Новости'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('backend','Редактирование');
?>
<div class="news-translate-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
