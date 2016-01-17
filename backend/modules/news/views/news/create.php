<?php

use backend\smile\components\SmileHtml;


/* @var $this yii\web\View */
/* @var $model backend\modules\news\models\News */

$this->title = Yii::t('backend','Создание новости');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend','Новости'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-translate-create">

    <h1><?= SmileHtml::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
