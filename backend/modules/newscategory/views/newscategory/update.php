<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\newscategory\models\Newscategory */

$this->title = Yii::t('backend','Редактирование категории') . ': ' . $model->t->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend','Лидеры'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('backend','Редактирование');
?>
<div class="newscategory-translate-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
