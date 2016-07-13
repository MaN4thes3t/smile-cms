<?php
use frontend\widgets\NewsOneSlider;
use frontend\widgets\VideoNewsSlider;
use frontend\widgets\TheVoiceOfCommunityMain;
use frontend\widgets\FocusOfTheWeekMain;
use frontend\widgets\InterviewMain;
use frontend\widgets\PhotoNewsSlider;
use frontend\widgets\AfishaMain;
use frontend\widgets\WeatherBlock;
use frontend\widgets\ZhitomirTodayMain;
use frontend\widgets\LeaderBirthday;
use frontend\widgets\AdviceMain;
use frontend\widgets\ZhitomirLive;
use frontend\widgets\NewsCategoryMain;
use frontend\widgets\CookeryMain;
?>
<div class="content-left">
    <?php echo ZhitomirTodayMain::widget()?>
    <?php echo WeatherBlock::widget()?>
    <?php echo AfishaMain::widget()?>
    <?php echo ZhitomirLive::widget()?>
    <?php echo CookeryMain::widget()?>
    <div class="calendar">
        <h2 class="blockHeader"></h2>
        <div class="control">
            <button class="prev"></button>
            <button class="next"></button>
        </div>
        <div class="calWrap">
            <ul class="calDay clear">
                <li><?php echo Yii::t('frontend', 'Пн')?></li>
                <li><?php echo Yii::t('frontend', 'Вт')?></li>
                <li><?php echo Yii::t('frontend', 'Ср')?></li>
                <li><?php echo Yii::t('frontend', 'Чт')?></li>
                <li><?php echo Yii::t('frontend', 'Пн')?></li>
                <li><?php echo Yii::t('frontend', 'Сб')?></li>
                <li><?php echo Yii::t('frontend', 'Нд')?></li>
            </ul>
            <ul class="calDate clear">

            </ul>
        </div>
    </div>
</div>
<div class="content-right">
    <?php echo NewsOneSlider::widget()?>
    <div class="clear"></div>
    <?php echo TheVoiceOfCommunityMain::widget()?>
    <div class="clear"></div>
    <?php echo VideoNewsSlider::widget()?>
    <div class="clear"></div>
    <?php echo FocusOfTheWeekMain::widget()?>
    <?php echo InterviewMain::widget()?>
    <div class="clear"></div>
    <?php echo PhotoNewsSlider::widget()?>
    <div class="clear"></div>
    <?php echo LeaderBirthday::widget()?>
    <div class="clear"></div>
    <?php echo AdviceMain::widget()?>
    <div class="clear"></div>
</div>
<div class="clear"></div>
<?php echo NewsCategoryMain::widget()?>
<script type="text/javascript">
    $(document).ready(function() {
        if($(".owl-carousel").length){
            $(".owl-carousel").owlCarousel({
                items: 3,
                loop: true,
                margin: 10,
                nav: true,
            });
        }
        if($(".owl-carousel-photo").length) {
            $(".owl-carousel-photo").owlCarousel({
                items: 3,
                loop: true,
                margin: 10,
                nav: true,
            });
        }
        if($(".owl-carousel-interview").length) {
            $(".owl-carousel-interview").owlCarousel({
                items: 1,
                loop: true,
                nav: true,
            });
        }
    });
</script>