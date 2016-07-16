<?php
use yii\helpers\Html;
use frontend\widgets\FamousPeopleHeader;
use frontend\widgets\MainNav;

\frontend\assets\AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?=Yii::$app->charset ?>"/>
    <?= Html::csrfMetaTags() ?>
    <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon" >
    <link href='https://fonts.googleapis.com/css?family=Noto+Sans:400,700&subset=latin,cyrillic-ext' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Scada:400,700&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>
    <div class="mainWrapper">
        <aside class="mainAside clear">
            <div class="firstAside">
                <div class="lang">
                    <ul class="clear">
                        <li class="ukr <?php if(Yii::$app->language == 'ua'){?>langActive<?php }?>">
                            <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl(['language'=>'ua'])?>" title="<?php echo Yii::t('frontend', 'Украинский')?>">
                                <?php echo Yii::t('frontend', 'Укр')?>
                            </a>
                        </li>
                        <li class="rus <?php if(Yii::$app->language == 'ru'){?>langActive<?php }?>">
                            <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl(['language'=>'ru'])?>" title="<?php echo Yii::t('frontend', 'Русский')?>">
                                <?php echo Yii::t('frontend', 'Рус')?>
                            </a>
                        </li>
                    </ul>
                </div>
<!--                <div class="helpNav">-->
<!--                    <ul class="clear">-->
<!--                        <li class="rss"><a href="#">RSS стрічка</a></li>-->
<!--                        <li class="mob"><a href="#">Моб. версія</a></li>-->
<!--                        <li class="logIn"><a href="#">Вхід</a></li>-->
<!--                        <li class="signIn"><a href="#">Реєстрація</a></li>-->
<!--                    </ul>-->
<!--                </div>-->
            </div>
            <div class="secondAside">
                <nav class="asideNav">
                    <ul class="clear">
                        <li><a title="<?php echo Yii::t('frontend', 'Главная')?>" href="<?php echo Yii::$app->urlManager->createAbsoluteUrl([])?>">
                                <?php echo Yii::t('frontend', 'Главная')?>
                            </a>
                        </li>
                        <li><a title="<?php echo Yii::t('frontend', 'Житомир LIVE')?>" href="<?php echo Yii::$app->urlManager->createAbsoluteUrl(['zhytomir-life'])?>">
                                <?php echo Yii::t('frontend', 'Житомир')?> <span class="red"><?php echo Yii::t('frontend', 'LIVE')?></span>
                            </a>
                        </li>
                        <li><a title="<?php echo Yii::t('frontend', 'Советы')?>" href="<?php echo Yii::$app->urlManager->createAbsoluteUrl([])?>">
                                <?php echo Yii::t('frontend', 'Советы')?>
                            </a>
                        </li>
                    </ul>
                </nav>
                <div class="asideSoc">
                    <ul class="clear">
                        <li class="vk">
                            <a href="#"></a>
                        </li>
                        <li class="fb">
                            <a href="#"></a>
                        </li>
                        <li class="ok">
                            <a href="#"></a>
                        </li>
                        <li class="youtube">
                            <a href="#"></a>
                        </li>
                    </ul>
                </div>
            </div>
        </aside>
        <section class="mainBlock">
            <?php echo FamousPeopleHeader::widget();?>
            <header class="mainHeader">
                <div class="logo">
                    <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl([])?>" title="<?php echo Yii::t('frontend', 'Главная')?>">
                        <img src="/images/logo.png" alt="zhitomir news logo">
                    </a>
                </div>
                <?php echo MainNav::widget();?>
                <div class="headerSearch">
                    <input type="text">
                </div>
                <div class="calendarTime">
                    <div class="calendarTimeTR">
                        <?php $date = getdate();
                        $week_days = [
                            '1' => Yii::t('frontend', 'Понедельник'),
                            '2' => Yii::t('frontend', 'Вторник'),
                            '3' => Yii::t('frontend', 'Среда'),
                            '4' => Yii::t('frontend', 'Четверг'),
                            '5' => Yii::t('frontend', 'Пятница'),
                            '6' => Yii::t('frontend', 'Суббота'),
                            '7' => Yii::t('frontend', 'Воскресенье'),
                        ];
                        $month = [
                            '1' => Yii::t('frontend', 'Январь'),
                            '2' => Yii::t('frontend', 'Февраль'),
                            '3' => Yii::t('frontend', 'Март'),
                            '4' => Yii::t('frontend', 'Апрель'),
                            '5' => Yii::t('frontend', 'Май'),
                            '6' => Yii::t('frontend', 'Июнь'),
                            '7' => Yii::t('frontend', 'Июль'),
                            '8' => Yii::t('frontend', 'Август'),
                            '9' => Yii::t('frontend', 'Сентябрь'),
                            '10' => Yii::t('frontend', 'Октябрь'),
                            '11' => Yii::t('frontend', 'Ноябрь'),
                            '12' => Yii::t('frontend', 'Декабрь'),
                        ];
                        ?>
                        <div class="calendarTimeTD month"><?php echo $month[$date['mon']]?></div>
                        <div class="calendarTimeTD day"><?php echo $week_days[$date['wday']]?></div>
                    </div>
                    <div class="calendarTimeTR">
                        <div class="calendarTimeTD date"><?php echo $date['mday'];?></div>
                        <div class="calendarTimeTD time"><?php echo $date['hours']?>:<?php echo $date['minutes']?></div>
                    </div>
                </div>
<!--                <div class="currency">-->
<!--                    <dl>-->
<!--                        --><?php
//                        $xml = simpleXML_load_file('https://api.privatbank.ua/p24api/pubinfo?exchange&coursid=3', "SimpleXMLElement", LIBXML_NOCDATA);
//                        $cur = array('USD', 'EUR');
//                        function xml2array ( $xmlObject, $out = array () )
//                        {
//                            foreach ( (array) $xmlObject as $index => $node )
//                                $out[$index] = ( is_object ( $node ) ) ? xml2array ( $node ) : $node;
//
//                            return $out;
//                        }
//                        if($xml->row){
//                            $xml = xml2array($xml->row);
//                            foreach($xml as $row){
//                                $arr = isset($row[0]['@attributes'])?$row[0]['@attributes']:$row['exchangerate']['@attributes'];
//                                if(in_array($arr['ccy'], $cur)){
//                                    $rate = (string)$arr['buy'];
//                                    $rate = intval($rate*100)/100;
//                                    $cur[$arr['ccy']] = $rate;
//                                }
//
//                            }
//                        }
//                        ?>
<!--                        <dt>--><?php //echo Yii::t('frontend', 'Курс валют')?><!--:</dt>-->
<!--                        <dd>$ --><?php //echo $cur['USD']?><!--, € --><?php //echo $cur['EUR']?><!--</dd>-->
<!--                    </dl>-->
<!--                </div>-->
                <nav class="siteNav">
                    <ul class="clear">
                        <li><a href="#">One News</a></li>
                        <li><a href="#">Новини</a></li>
                        <li><a href="#">Точка зору</a></li>
                        <li><a href="#">Слово громаді</a></li>
                        <li><a href="#">ФотоNews</a></li>
                        <li><a href="#">ВідеоNews</a></li>
                        <li><a href="#">Інтерв’ю</a></li>
                        <li><a href="#">Аналітика</a></li>
                        <li><a href="#">Новини України</a></li>
                        <li><a href="#">Світові новини</a></li>
                        <li><a href="#">Mix News</a></li>
                    </ul>
                </nav>
            </header>
            <section class="content">
                <?= $content ?>
                <footer class="mainFooter">
                    <nav class="fSiteNav">
                        <ul class="clear">
                            <li><a href="#" title="">ГОЛОВНА</a></li>
                            <li><a href="#" title="">НОВИНИ</a></li>
                            <li><a href="#" title="">ФОТОНОВИНИ</a></li>
                            <li><a href="#" title="">ВІДЕОНОВИНИ</a></li>
                            <li><a href="#" title="">ОГЛЯД ПРЕСИ</a></li>
                            <li><a href="#" title="">ТАБЛОID</a></li>
                            <li><a href="#" title="">ЛІДЕРИ</a></li>
                        </ul>
                    </nav>
                    <?php echo MainNav::widget(['footer'=>true]);?>
                    <div class="rights"><p><?php echo Yii::t('frontend', 'Адміністрація сайту Житомир Ньюс може не поділяти думку автора та не несе відповідальність за авторські матеріали. При повному або частковому використанні матеріалів сайту Житомир Ньюс посилання на ZНitomirNEWS.com обов’язкове, а для інтернет - ресурсів гіперпосилання.')?></p></div>
                    <div class="copyright"><p>© 2008 - <?php echo $date['year']?>, <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl([])?>" title="">zhitomirnews.com</a></p></div>
                </footer>
            </section>

        </section>
    </div>

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
