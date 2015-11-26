<?php

use backend\smile\components\SmileHtml;


/* @var $this yii\web\View */
/* @var $model backend\modules\advice\models\Advice */

$this->title = Yii::t('backend','Создание совета');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend','Советы'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="advice-translate-create">

    <h1><?= SmileHtml::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
