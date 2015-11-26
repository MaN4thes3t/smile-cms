<?php

use backend\smile\components\SmileHtml;


/* @var $this yii\web\View */
/* @var $model backend\modules\language\models\Language */

$this->title = Yii::t('backend','Создание языка');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend','Языки'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dictionary-translate-create">

    <h1><?= SmileHtml::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
