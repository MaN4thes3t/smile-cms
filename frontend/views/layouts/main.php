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
<!--    <link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon" >-->
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>
    <header>
        <div class="innerwrapper">
            <a href="<?=Yii::$app->urlManager->createUrl('/')?>" id="logo"></a>
            <div id="header-text">
                <div id="athletics"></div>
                <div id="baku"></div>
            </div>
            <div id="logo2"></div>
            <div id="social_languages">
                <div id="social">
                    <a href="#" id="vk"></a>
                    <a href="#" id="fb"></a>
                    <a href="#" id="twitter"></a>
                    <a href="#" id="ok"></a>
                    <a href="#" id="youtube"></a>
                    <a href="#" id="gplus"></a>
                </div>
                <div class="lang_value"></div>
                <ul id="lang">
                    <li class="active"><a href="#">ENG</a></li>
                    <li><a href="#">RU</a></li>
                </ul>
            </div>
            <form id="search">
                <input type="text" placeholder="Search"/>
                <input type="submit" value="" class="search_submit"/>
            </form>
            <nav>
                <ul class="nav1">
                    <?=MenuWidget::widget([
                        'page'=>Yii::$app->params['page']
                    ]);?>
                </ul>
            </nav>
        </div>
    </header>
    <article class="<?=(Yii::$app->controller->id == 'news'
        || Yii::$app->controller->id == 'photo'
        || Yii::$app->controller->id == 'partners'
        || Yii::$app->controller->id == 'video'
        )?'article-two':''?>">
        <div class="innerwrapper <?=(Yii::$app->controller->id == 'news'
            || Yii::$app->controller->id == 'photo'
            || Yii::$app->controller->id == 'video'
            || Yii::$app->controller->id == 'partners'
            )?'no-bg':''?>">
            <?= $content ?>
        </div>
    </article>

    <footer class="foot-two">
        <div class="innerwrapper">
            <div class="col-md-4">
                <h6 class="footer-title"><?=Yii::t('frontend','contact us')?></h6>
                <form class="contact-us">
                    <p><?=Yii::t('frontend','Name')?>*:</p>
                    <input type="text" />
                    <p><?=Yii::t('frontend','E-mail')?>*::</p>
                    <input type="text" />
                    <p><?=Yii::t('frontend','Text')?></p>
                    <textarea placeholder="Type your message here."></textarea>
                    <p>Security code*:</p>
                    <img src="images/capcha.png"/><input type="text" class="capcha" /><input type="submit" value="Submit"/>
                </form>
            </div>
            <div class="col-md-4">
                <h6 class="footer-title"><?=Yii::t('frontend','home')?></h6>
                <nav>
                    <ul>
                        <?=MenuWidget::widget([
                            'page'=>Yii::$app->params['page']
                        ]);?>
                    </ul>
                </nav>
                <h6 class="footer-title"><?=Yii::t('frontend','we are in social media')?></h6>
            </div>
            <div class="col-md-4">
                <h6 class="footer-title"><?=Yii::t('frontend','contacts')?></h6>
                <div class="footer-contacts">
                    <div id="location">
                        <p><?=Yii::t('frontend','Azerbaijan, Baku Naberezhnaya, 80')?></p>
                    </div>
                    <div id="phones">
                        <a><?=Yii::t('frontend','+38 (068) 250 36 69')?></a>
                        <a><?=Yii::t('frontend','+38 (068) 250 36 69')?></a>
                    </div>
                    <div id="email">
                        <a href="mailto:<?=Yii::t('frontend','street_athletics@mail.ru')?>"><?=Yii::t('frontend','street_athletics@mail.ru')?></a>
                    </div>
                    <div id="socials">
                        <a href="#" class="vk"></a>
                        <a href="#" class="fb"></a>
                        <a href="#" class="twit"></a>
                        <a href="#" class="ok"></a>
                        <a href="#" class="ut"></a>
                        <a href="#" class="gp"></a>
                    </div>
                </div>
            </div>
        </div>
        <div id="allRights">&copy; <?=Yii::t('frontend','2015 All rights reserved. Developed in')?> <a href="http://seotm.com/"><?=Yii::t('frontend','SEOTM')?></a></div>
    </footer>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
