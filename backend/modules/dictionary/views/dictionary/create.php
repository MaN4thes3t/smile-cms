<?php

use backend\smile\components\SmileHtml;


/* @var $this yii\web\View */
/* @var $model backend\modules\dictionary\models\Dictionary */

$this->title = Yii::t('backend','Создание перевода');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend','Словарь переводов'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dictionary-translate-create">

    <h1><?= SmileHtml::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
