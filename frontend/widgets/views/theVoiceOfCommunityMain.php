
<?php
use yii\helpers\VarDumper;
if($news){
    ?>
    <div class="todayWord">
        <h2 class="blockHeader">
            <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('/the-voice-of-community/')?>"
               title="<?php echo Yii::t('frontend', 'СЛОВО ОБЩЕСТВЕННОСТИ')?>">
                <?php echo Yii::t('frontend', 'СЛОВО ОБЩЕСТВЕННОСТИ')?>
            </a>
        </h2>
        <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('/the-voice-of-community/'.$news['translit'])?>"
           title="" class="blockNext"><?php echo Yii::t('frontend', 'Больше')?> →</a>
        <h3>
            <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('/the-voice-of-community/'.$news['translit'])?>"
               title="<?php echo $news['t']['title']?>">
                <?php echo $news['t']['title']?>
            </a>
        </h3>
        <figure>
            <?php if($news['photo']){
               ?>
                <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('/the-voice-of-community/'.$news['translit'])?>"
                   title="<?php echo $news['t']['title']?>">
                    <img src="<?php echo '/uploads/NewsPhoto/'.$news['id'].'/'.$news['photo']?>" alt="<?php echo $news['t']['first_name'].' '.$news['t']['second_name']?>">
                </a>
                <?php
            }?>

            <figcaption>
                <p>
                    <?php echo $news['t']['first_name']?><br><?php echo $news['t']['second_name']?>
                </p>
            </figcaption>
        </figure>
        <p><a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('/the-voice-of-community/'.$news['translit'])?>"
              title="<?php echo $news['t']['title']?>">
                <?php echo $news['t']['short_description']?></a></p>
    </div>
    <?php
}