
<?php
use yii\helpers\VarDumper;
use frontend\smile\components\ImageHelper;
if($news){
    ?>
    <div class="mainSlider">
        <div class="sliderDiv">
            <ul class="sliderWrap">
                <?php foreach($news as $one){
                    ?>
                    <li class="sliderItem">
                        <div class="sliderItemWrap">
                            <a title="<?echo $one['t']['title']?>" href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('/news-one/'.$one['translit'])?>">
                                <img src="<?php echo ImageHelper::buildImgPathBig(current($one['images']))?>" alt="<?echo $one['t']['title']?>">
                            </a>
                            <h2>
                                <a title="<?php echo Yii::t('frontend', 'NEWS ONE')?>" href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('/news-one/')?>"><?php echo Yii::t('frontend', 'NEWS ONE')?></a>
                            </h2>
                            <time>
                                <?php
//                                $create_date = date('Y-m-d',$one['create_date']);
//                                $today = date('Y-m-d');
                                $is_today =  date('Y-m-d',$one['create_date']) == date('Y-m-d');
                                $is_yesterday = date('Y-m-d',$one['create_date']) == date('Y-m-d', strtotime('-1 day'));
                                $yesterday_date = $is_yesterday?Yii::t('frontend','ВЧЕРА'):date('d.m.y',$one['create_date']);
                                ?>
                                <a title="<?echo $one['t']['title']?>" href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('/news-one/'.$one['translit'])?>"><?php echo $is_today?Yii::t('frontend','СЕГОДНЯ'):$yesterday_date?> <?php echo date('H:i', $one['create_date'])?></a>
                            </time>
                            <p>
                                <a title="<?echo $one['t']['title']?>" href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('/news-one/'.$one['translit'])?>"><?echo $one['t']['title']?></a>
                            </p>
<!--                                    <span>-->
<!--                                        <a href="#">М.Саакашвілі</a>-->
<!--                                    </span>-->
                        </div>
                    </li>
                    <?php
                    reset($one['images']);
                }?>
            </ul>
        </div>
        <ul class="sliderControls">
            <?php foreach($news as $one){
                ?>
                <li>
                    <img src="<?php echo ImageHelper::buildImgPathThumbnail(current($one['images']))?>" alt="<?echo $one['t']['title']?>">
                </li>
                <?php
            }?>
        </ul>
    </div>
    <?php
}