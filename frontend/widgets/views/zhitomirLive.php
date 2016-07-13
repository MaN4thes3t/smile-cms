
<?php
use yii\helpers\VarDumper;
use frontend\smile\components\ImageHelper;
if($news){
    ?>
    <div class="zhitomirLive">
        <div class="verticalTextWrapper">
            <h2 class="verticalText">
                <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('/zhytomir-live/')?>"
                   title="<?php echo Yii::t('frontend', 'Житомир Live')?>">
                    <?php echo Yii::t('frontend', 'Житомир')?> <span><?php echo Yii::t('frontend', 'Live')?></span>
                </a>
            </h2>
        </div>
        <div class="zhitomirLiveImgWrap">
            <a <?php if(!$one['images']){?>class="no-image"<?php }?> href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('/zhytomir-live/'.$news['translit'])?>"
               title="<?php echo $news['t']['title']?>">
                <?php
                if($news['images']){
                    $path = ImageHelper::buildImgPathBig(current($news['images']));
                }else{
                    $path = Yii::$app->params['no_image_big'];
                }
                ?>
                <img src="<?php echo $path?>" alt="<?php echo $news['t']['title']?>">
            </a>
        </div>
        <p class="zhitomirLiveHeader">
            <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('/zhytomir-live/'.$news['translit'])?>"
               title="<?php echo $news['t']['title']?>">
                <?php echo $news['t']['title']?></a>
        </p>
        <p class="zhitomirLiveDesc">
            <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('/zhytomir-live/'.$news['translit'])?>"
               title="<?php echo $news['t']['short_description']?>">
                <?php echo $news['t']['short_description']?>
                </a></p>
    </div>
    <?php
}