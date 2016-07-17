
<?php
use yii\helpers\VarDumper;
use frontend\smile\components\ImageHelper;
if($news){
    ?>
    <div class="focusOfTheWeek">
        <h2 class="blockHeader">
            <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('/focus-of-the-week')?>"
               title="<?php echo Yii::t('frontend', 'Акценти тижня')?>"><?php echo Yii::t('frontend', 'Акценты недели')?></a></h2>
        <ul class="clear">
            <?php foreach($news as $one){
                ?>
                <li>
                            <p><a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('/focus-of-the-week/'.$one['translit'])?>"
                                  title="<?php echo $one['t']['title']?>">
                                    <?php echo $one['t']['title']?></a></p>
                </li>
                <?php
            }?>


        </ul>
    </div>
    <?php
}