
<?php
use yii\helpers\VarDumper;
use frontend\smile\components\ImageHelper;
if($news){
    ?>
    <div class="afisha">
        <div class="moreNews clear">
            <?php foreach($news as $key=>$one){
                if($key == 0){
                    ?>
                    <div class="main">
                        <div class="afishaImgWrap">
                            <a <?php echo !$one['images']?'class="no-image"':''?> href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('/poster/'.$one['translit'])?>"
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
                        <div class="afishaDesc">
                            <h2>
                                <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('/poster/')?>"
                                   title="<?php echo Yii::t('frontend', 'АФИША')?>">
                                    <?php echo Yii::t('frontend', 'АФИША')?>
                                </a>
                            </h2>
                            <p>
                                <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('/poster/'.$one['translit'])?>"
                                   title="<?php echo $one['t']['title']?>">
                                    <?php echo $one['t']['title']?>
                                </a>
                            </p>
                            <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('/poster/'.$one['translit'])?>"
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
                        </div>
                    </div>
                    <?php
                }else{
                    ?>
                    <figure class="clear">
                        <div class="moreNewsImgWrap">
                            <a <?php echo !$one['images']?'class="no-image"':''?> href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('/poster/'.$one['translit'])?>" title="<?php echo $one['t']['title']?>">
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
                        </div>
                        <figcaption>
                            <p>
                                <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('/poster/'.$one['translit'])?>"
                                   title="<?php echo $one['t']['title']?>">
                                    <?php echo $one['t']['title']?>
                                </a>
                            </p>
                            <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('/poster/'.$one['translit'])?>" title="<?php echo $one['t']['title']?>">
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
                        </figcaption>
                    </figure>
                    <?php
                }
            }?>
        </div>
    </div>
    <?php
}