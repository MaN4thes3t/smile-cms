
<?php
use yii\helpers\VarDumper;
use frontend\smile\components\ImageHelper;
if($news){
    ?>
    <div class="zhitomirLive">
        <div class="h2Wrap">
            <h2><a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('/zhytomir-live')?>"
                   title="<?php echo Yii::t('frontend', 'Житомир Live')?>"><?php echo Yii::t('frontend', 'Житомир')?> <span><?php echo Yii::t('frontend', 'Live')?></span></a></h2>
            <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('/zhytomir-live')?>"
            title="<?php echo Yii::t('frontend', 'Житомир Live')?>" class="zLwatch"><?php echo Yii::t('frontend', 'Дивитись все')?> →</a>
        </div>
        <?php
        foreach($news as $one){
            ?>
            <figure class="clear">
                <div class="moreNewsImgWrap">
                    <a <?php if(!$one['images']){?>class="no-image"<?php }?> href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('/zhytomir-live/'.$one['translit'])?>"
                       title="<?php echo $one['t']['title']?>">
                        <?php
                        if($one['images']){
                            $path = ImageHelper::buildImgPathBig(current($one['images']));
                        }else{
                            $path = Yii::$app->params['no_image_big'];
                        }
                        ?>
                        <img src="<?php echo $path?>" alt="<?php echo $one['t']['title']?>">
                    </a>
                </div>
                <figcaption>
                    <p><a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('/zhytomir-live/'.$one['translit'])?>"
                          title="<?php echo $one['t']['title']?>">
                            <?php echo $one['t']['title']?></a></p>
                </figcaption>
            </figure>
            <?php
        }
        ?>
    </div>
    <?php
}