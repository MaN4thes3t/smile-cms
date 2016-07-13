
<?php
use yii\helpers\VarDumper;
use frontend\smile\components\ImageHelper;
if($advices){
    ?>
    <div class="advice">
        <h2 class="blockHeader">
            <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('/advice/')?>"
               title="<?php echo Yii::t('frontend', 'ПОРАДНИЦЯ')?>">
                <?php echo Yii::t('frontend', 'ПОРАДНИЦЯ')?>
            </a>
        </h2>
        <ul class="clear">
            <?php
            foreach($advices as $advice){
                ?>
                <li><a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('/advice/'.$advice['translit'])?>"
                       title="<?php echo $advice['t']['title']?>">
                        <?php echo $advice['t']['title']?>
                    </a></li>
                <?php
            }
            ?>
        </ul>
    </div>
    <?php
}