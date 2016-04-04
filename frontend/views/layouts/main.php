<?php
use yii\helpers\Html;
use frontend\assets\MainAsset;
use frontend\widgets\MenuWidget;
/* @var $this \yii\web\View */
/* @var $content string */

MainAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?=Yii::$app->charset ?>"/>
    <?= Html::csrfMetaTags() ?>
    <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon" >
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>
        <?= $content ?>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
