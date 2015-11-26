<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\leader\models\Leader */

$this->title = Yii::t('backend','Редактирование лидера') . ': ' . $model->t->first_name.' '.$model->t->last_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend','Лидеры'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('backend','Редактирование');
?>
<div class="leader-translate-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
