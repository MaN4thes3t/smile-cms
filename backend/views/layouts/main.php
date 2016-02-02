<?php
use backend\assets\AppAsset;
use backend\smile\components\SmileHtml;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

/* @var $this \yii\web\View */
/* @var $content string */
AppAsset::register($this);
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= SmileHtml::csrfMetaTags() ?>
    <title><?= SmileHtml::encode($this->title) ?></title>
    <link rel="icon" type="image/png" href="/images/favicon.ico">
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>
    <div id="wrapper">
        <nav class="navbar-inverse" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
<!--                --><?//= SmileHtml::a(Yii::t('backend','Smile CMS'), ['/'], ['class' => 'navbar-brand']) ?>
            </div>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <?php $nav = [
                        Yii::t('backend','Новости') => [
                            'url'=>Url::toRoute(['/news/news'],true),
                            'controller'=>'news'
                        ],
                        Yii::t('backend','Категории новостей') => [
                            'url'=>Url::toRoute(['/newscategory/newscategory'],true),
                            'controller'=>'newscategory'
                        ],
                        Yii::t('backend','Опросы') => [
                            'url'=>Url::toRoute(['/poll/poll'],true),
                            'controller'=>'poll'
                        ],
                        Yii::t('backend','Советы') => [
                            'url'=>Url::toRoute(['/advice/advice'],true),
                            'controller'=>'advice'
                        ],
                        Yii::t('backend','Страницы') => [
                            'url'=>Url::toRoute(['/page/page'],true),
                            'controller'=>'page'
                        ],
                        Yii::t('backend','Лидеры') => [
                            'url'=>Url::toRoute(['/leader/leader'],true),
                            'controller'=>'leader'
                        ],
                        Yii::t('backend','Теги') => [
                            'url'=>Url::toRoute(['/tag/tag'],true),
                            'controller'=>'tag'
                        ],
                        Yii::t('backend','Управление языками') => [
                            'url'=>Url::toRoute(['/language/language'],true),
                            'controller'=>'language'
                        ],
                        Yii::t('backend','Словарь переводов') => [
                            'url'=>Url::toRoute(['/dictionary/dictionary'],true),
                            'controller'=>'dictionary'
                        ],
//                        Yii::t('backend','Выход') => [
//                            'url'=>Url::toRoute(['/site/logout'],true),
//                            'controller'=>''
//                        ],
                    ];?>
                    <?php foreach($nav as $k=>$v):
                        ?>
                        <li class="<?= Yii::$app->controller->id==$v['controller']?'active':''?>">
                            <?= SmileHtml::a($k, $v['url']) ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </nav>

        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <?= Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ]) ?>
                    <div class="main-content">
                        <?= $content ?>
                    </div>
                </div>

            </div>
            <div class="bottom_language_container">
                <?=SmileHtml::button(SmileHtml::a(Yii::t('backend','Выход'),Url::toRoute(['/site/logout'],true)),['class'=>'btn logout']) ?>
                <?=SmileHtml::dropDownList('select_language',Yii::$app->language,ArrayHelper::map(
                    Yii::$app->params['languages'],
                    'code',function($data){
                    return $data['name'].' / '.$data['translate'][Yii::$app->language]['translate'];
                }),[
                    'class'=>'form-control',
                    'id'=>'select_language'
                ])?>
            </div>
        </div>

    </div>

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();
?>
