
<?php
use yii\helpers\VarDumper;
use frontend\smile\components\ImageHelper;
if($news){
    ?>
    <div class="photoNewsSlider">
        <h2>
            <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('/photo-news/')?>"
               title="<?php echo Yii::t('frontend', 'ФОТОNEWS')?>">
                <?php echo Yii::t('frontend', 'ФОТОNEWS')?>
            </a>
        </h2>
        <div class="owl-carousel-photo">
            <?php foreach($news as $one){
                ?>
                <div>
                    <a <?php echo !$one['images']?'class="no-image"':''?> href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('/photo-news/'.$one['translit'])?>"
                       title="<?php echo $one['t']['title']?>" class="imgWrap">
                        <?php
                        if($one['images']){
                            $path = ImageHelper::buildImgPathThumbnail(current($one['images']));
                        }else{
                            $path = Yii::$app->params['no_image_small'];
                        }
                        ?>
                        <img src="<?php echo $path?>"
                             alt="<?php echo $one['t']['title']?>">
                    </a>
                    <p class="videoCaption">
                        <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('/photo-news/'.$one['translit'])?>"
                           title="<?php echo $one['t']['title']?>">
                            <?php echo $one['t']['title']?>
                        </a>
                    </p>
                    <p class="videoDesc">
<!--                        <a href="#" title="">Народний контроль</a>-->
                        <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('/photo-news/'.$one['translit'])?>"
                           title="<?php echo $one['t']['title']?>">
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

                        </a>
                    </p>
                </div>
            <?php
            }?>
        </div>
    </div>
    <?php
}