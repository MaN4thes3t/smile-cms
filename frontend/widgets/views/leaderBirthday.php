
<?php
use yii\helpers\VarDumper;
use frontend\smile\components\ImageHelper;
if($leaders){
    ?>
    <div class="birthday">
        <h2 class="blockHeader">
            <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('/leaders/')?>"
               title="<?php echo Yii::t('frontend', 'ІМЕНИННИКИ СЬОГОДНІ')?>"
            >
                <?php echo Yii::t('frontend', 'ІМЕНИННИКИ СЬОГОДНІ')?>
            </a>
        </h2>
        <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('/leaders/')?>"
           title="<?php echo Yii::t('frontend', 'Переглянути всіх')?>"
           class="blockNext"><?php echo Yii::t('frontend', 'Переглянути всіх')?> →</a>
        <div>
            <?php
            foreach($leaders as $leader){
                $name = $leader['t']['first_name'].' '.$leader['t']['last_name'];
                ?>
                <figure>
                    <div class="birthdayImgWrap">
                        <a <?php echo !$leader['images']?'class="no-image"':''?> href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('/leaders/'.$leader['translit'])?>"
                           title="<?php echo $name?>">
                            <?php
                            if($leader['images']){
                                $path = ImageHelper::buildImgPathThumbnail(current($leader['images']));
                            }else{
                                $path = Yii::$app->params['no_image_small'];
                            }
                            ?>
                            <img src="<?php echo $path?>" alt="<?php echo $name?>"></a>
                    </div>
                    <figcaption>
                        <h3><a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('/leaders/'.$leader['translit'])?>"
                               title="<?php echo $name?>"><?php echo $name?></a></h3>
                        <p><a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('/leaders/'.$leader['translit'])?>"
                              title="<?php echo $name?>"><?php echo $leader['t']['description']?></a></p>
                        <p><a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('/leaders/'.$leader['translit'])?>"
                              title="<?php echo $name?>">
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
                            </a></p>
                    </figcaption>
                </figure>
                <?php
            }
            ?>


        </div>
    </div>
    <?php
}