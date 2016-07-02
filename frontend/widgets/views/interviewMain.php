
<?php
use yii\helpers\VarDumper;
use frontend\smile\components\ImageHelper;
if($news){
    ?>
    <div class="interview">
        <h2 class="blockHeader">
            <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('/interview/')?>" title="<?php echo Yii::t('frontend', 'ИНТЕРВЬЮ')?>">
                <?php echo Yii::t('frontend', 'ИНТЕРВЬЮ')?>
            </a>
        </h2>
        <div class="owl-carousel-interview">
            <?php foreach($news as $one){
                ?>
                <div>
                    <div class="interviewImgWrapper">
                        <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('/interview/'.$one['translit'])?>"
                           title="<?php echo $one['t']['title']?>">
                            <img src="<?php echo ImageHelper::buildImgPathBig(current($one['images']))?>"
                                 alt="<?php echo $one['t']['title']?>">
                        </a>
                    </div>
                    <p><a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('/interview/'.$one['translit'])?>"
                          title="<?php echo $one['t']['title']?>"><?php echo $one['t']['title']?>
                        </a>
                    </p>
                </div>
                <?php
            }?>
        </div>
    </div>
    <?php
}