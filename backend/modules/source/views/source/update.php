<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\source\models\Source */

$this->title = Yii::t('backend','Редактирование источника') . ': ' . $model->t->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend','Иточники'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('backend','Редактирование');
?>
<div class="source-translate-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
