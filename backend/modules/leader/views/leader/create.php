<?php

use backend\smile\components\SmileHtml;


/* @var $this yii\web\View */
/* @var $model backend\modules\leader\models\Leader */

$this->title = Yii::t('backend','Создание лидера');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend','Лидеры'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="leader-translate-create">

    <h1><?= SmileHtml::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
