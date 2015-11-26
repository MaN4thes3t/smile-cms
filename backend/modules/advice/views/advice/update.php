<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\advice\models\Advice */

$this->title = Yii::t('backend','Редактирование совета') . ': ' . $model->t->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend','Советы'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('backend','Редактирование');
?>
<div class="advice-translate-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
