<?php
use frontend\widgets\ZhitomirTodayMain;
use frontend\widgets\NewsOneSlider;
use frontend\widgets\TheVoiceOfCommunityMain;
use frontend\widgets\AfishaMain;
?>
<div class="videoNewsWrap">

</div>
<div class="asideInfo">
    <?php echo ZhitomirTodayMain::widget()?>
    <?php echo NewsOneSlider::widget(['count' => 3])?>
    <div class="clear"></div>
    <?php echo TheVoiceOfCommunityMain::widget()?>
    <div class="clear"></div>
    <div class="zhitomirLive">
        <div class="h2Wrap">
            <h2><a href="#">Житомир<span>LIVE</span></a></h2>
            <a href="#" class="zLwatch">Дивитись все →</a>
        </div>
        <figure class="clear">
            <div class="moreNewsImgWrap">
                <a href="#" title=""><img src="images/slider/2.jpg" alt=""></a>
            </div>
            <figcaption>
                <p><a href="#" title="">Разведчик 95-ой бригады Иван Трембовецкий: Как мы выходили из Дебальцево</a></p>
            </figcaption>
        </figure>
        <figure class="clear">
            <div class="moreNewsImgWrap">
                <a href="#" title=""><img src="images/slider/2.jpg" alt=""></a>
            </div>
            <figcaption>
                <p><a href="#" title="">Народний контроль перевірить обіцянки луцьких</a></p>
            </figcaption>
        </figure>
        <figure class="clear">
            <div class="moreNewsImgWrap">
                <a href="#" title=""><img src="images/slider/2.jpg" alt=""></a>
            </div>
            <figcaption>
                <p><a href="#" title="">Народний контроль перевірить обіцянки луцьких</a></p>
            </figcaption>
        </figure>
    </div>
    <?php echo AfishaMain::widget()?>
</div>
<div class="clear"></div>