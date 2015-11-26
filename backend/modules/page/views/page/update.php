<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\page\models\Page */

$this->title = Yii::t('backend','Редактирование страницы') . ': ' . $model->t->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend','Страницы'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('backend','Редактирование');
?>
<div class="page-translate-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
