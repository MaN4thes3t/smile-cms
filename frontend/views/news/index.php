<?php
use frontend\widgets\ZhitomirTodayMain;
use frontend\widgets\NewsOneSlider;
use frontend\widgets\TheVoiceOfCommunityMain;
use frontend\widgets\AfishaMain;
?>
<div class="videoNewsWrap">
    <?php echo \frontend\widgets\OneNews::widget(['news'=>$news])?>
</div>
<div class="asideInfo">
    <?php echo ZhitomirTodayMain::widget()?>
    <?php echo NewsOneSlider::widget(['count' => 3])?>
    <div class="clear"></div>
    <?php echo TheVoiceOfCommunityMain::widget()?>
    <div class="clear"></div>
    <?php echo \frontend\widgets\ZhitomirLiveAside::widget()?>
    <div class="clear"></div>
    <?php echo AfishaMain::widget()?>
</div>
<div class="clear"></div>