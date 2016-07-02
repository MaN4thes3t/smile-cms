<?php

use backend\smile\components\SmileHtml;


/* @var $this yii\web\View */
/* @var $model backend\modules\source\models\Source */

$this->title = Yii::t('backend','Создание источника');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend','Источники'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="source-translate-create">

    <h1><?= SmileHtml::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
