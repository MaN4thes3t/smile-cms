
<?php
use yii\helpers\VarDumper;
use frontend\smile\components\ImageHelper;
if($news){
    ?>
    <div class="interview">
        <h2 class="blockHeader">
            <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('/interview')?>" title="<?php echo Yii::t('frontend', 'ИНТЕРВЬЮ')?>">
                <?php echo Yii::t('frontend', 'ИНТЕРВЬЮ')?>
            </a>
        </h2>
        <ul class="clear">
            <?php foreach($news as $one){
                ?>
                <li>
                    <figure>
                        <div class="blogImgWrapper">
                            <a <?php echo !$one['images']?'class="no-image"':''?>
                                href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('/interview/'.$one['translit'])?>"
                                title="<?php echo $one['t']['title']?>">
                                <?php
                                if($one['images']){
                                    $path = ImageHelper::buildImgPathBig(current($one['images']));
                                }else{
                                    $path = Yii::$app->params['no_image_big'];
                                }
                                ?>
                                <img src="<?php echo $path?>"
                                     alt="<?php echo $one['t']['title']?>">
                            </a>
                        </div>
                        <figcaption>
                            <p><a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('/interview/'.$one['translit'])?>"
                                  title="<?php echo $one['t']['title']?>"><?php echo $one['t']['title']?>
                                </a>
                            </p>
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
                            <time><?php echo $date['mday'].' '.$month[$date['mon']].' '.date('H:i', $one['create_date'])?></time>
                        </figcaption>

                    </figure>
                </li>
                <?php
            }?>
        </ul>
    </div>
    <?php
}