<?php

use backend\smile\components\SmileHtml;


/* @var $this yii\web\View */
/* @var $model backend\modules\newscategory\models\Newscategory */

$this->title = Yii::t('backend','Создание категории');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend','Категории'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="newscategory-translate-create">

    <h1><?= SmileHtml::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
