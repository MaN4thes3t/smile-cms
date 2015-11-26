<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\dictionary\models\Dictionary */

$this->title = Yii::t('backend','Редактирование перевода') . ': ' . $model->message;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend','Словарь переводов'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('backend','Редактирование');
?>
<div class="dictionary-translate-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
