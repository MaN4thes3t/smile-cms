<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\tag\models\Tag */

$this->title = Yii::t('backend','Редактирование тега') . ': ' . $model->t->text;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend','Теги'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('backend','Редактирование');
?>
<div class="tag-translate-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
