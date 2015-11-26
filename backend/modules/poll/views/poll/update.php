<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\poll\models\Poll */

$this->title = Yii::t('backend','Редактирование опроса') . ': ' . $model->t->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend','Опросы'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('backend','Редактирование');
?>
<div class="poll-translate-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
