<?php

use backend\smile\components\SmileHtml;


/* @var $this yii\web\View */
/* @var $model backend\modules\page\models\Page */

$this->title = Yii::t('backend','Создание страницы');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend','Страницы'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-translate-create">

    <h1><?= SmileHtml::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
