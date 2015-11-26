<?php
/**
 * Created by PhpStorm.
 * User: Артём
 * Date: 23.05.2015
 * Time: 14:56
 */
?>
<h1 class="title"><?=Yii::t('frontend','Video')?></h1>
<div id="video-list">
    <?php foreach($videos as $video){
        ?>
        <div class="col-md-4">
            <a href="<?=$video->video?>" class="video-hover"></a>
            <div class="video-pic">
                <img src="<?='http://img.youtube.com/vi/JMJXvsCLu6s/mqdefault.jpg'?>"/>
            </div>
            <div class="video-title"><?=$video->t->title?></div>
        </div>
        <?php
    }?>
</div>