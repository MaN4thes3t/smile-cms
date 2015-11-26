<?php

use backend\smile\components\SmileHtml;

/* @var $this yii\web\View */
/* @var $model backend\modules\language\models\Language */

$this->title = Yii::t('backend','Редактирования языка') . ': ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend','Языки'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('backend','Редактирование');
?>
<div class="dictionary-translate-update">

    <h1><?= SmileHtml::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
