
<?php
use yii\helpers\VarDumper;
use frontend\smile\components\ImageHelper;
if($news){
    ?>
    <div class="focusOfTheWeek">
        <h2 class="blockHeader">
            <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('/focus-of-the-week/')?>"
               title="<?php echo Yii::t('frontend', 'Акценти тижня')?>"><?php echo Yii::t('frontend', 'Акценты недели')?></a></h2>
        <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('/focus-of-the-week/')?>" class="blockNext"><?php echo Yii::t('frontend', 'Больше')?> →</a>
        <ul class="clear">
            <?php foreach($news as $one){
                ?>
                <li>
                    <figure>
                        <div class="blogImgWrapper">
                            <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('/focus-of-the-week/'.$one['translit'])?>"
                               title="<?php echo $one['t']['title']?>">
                                <img src="<?php echo ImageHelper::buildImgPathThumbnail(current($one['images']))?>" alt="<?php echo $one['t']['title']?>">
                            </a>
                        </div>
                        <figcaption>
<!--                            <h3><a href="#" title="">Анастасія Гармаш:</a></h3>-->
                            <p><a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('/focus-of-the-week/'.$one['translit'])?>"
                                  title="<?php echo $one['t']['title']?>">
                                    <?php echo $one['t']['title']?></a></p>
                            <time>
                                <?php
                                $month = [
                                    '1' => Yii::t('frontend', 'января'),
                                    '2' => Yii::t('frontend', 'февраля'),
                                    '3' => Yii::t('frontend', 'марта'),
                                    '4' => Yii::t('frontend', 'апреля'),
                                    '5' => Yii::t('frontend', 'мая'),
                                    '6' => Yii::t('frontend', 'июня'),
                                    '7' => Yii::t('frontend', 'июля'),
                                    '8' => Yii::t('frontend', 'августа'),
                                    '9' => Yii::t('frontend', 'сентября'),
                                    '10' => Yii::t('frontend', 'октября'),
                                    '11' => Yii::t('frontend', 'ноября'),
                                    '12' => Yii::t('frontend', 'декабря'),
                                ];
                                $date = getdate($one['create_date']);
                                ?>
                                <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('/focus-of-the-week/'.$one['translit'])?>" title="<?php echo $one['t']['title']?>">
                                    <?php echo $date['mday'].' '.$month[$date['mon']].' '.date('H:i', $one['create_date'])?></a>
                            </time>
                        </figcaption>
                    </figure>
                </li>
                <?php
            }?>


        </ul>
    </div>
    <?php
}