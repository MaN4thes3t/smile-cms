
<?php
use yii\helpers\VarDumper;
use frontend\smile\components\ImageHelper;
use yii\widgets\LinkPager;
if($news && $category){
    ?>
    <div class="zhitomirToday">
        <div>
            <h2>
                <a title="<?php echo Yii::t('frontend', 'ЖИТОМИРЩИНА СЬОГОДНІ')?>"
                   href="<?php echo Yii::$app->urlManager->createAbsoluteUrl($category->translit)?>">
                    <?php echo Yii::t('frontend', 'ЖИТОМИРЩИНА СЬОГОДНІ')?>
                </a>
            </h2>
        </div>
        <?php foreach($news as $key => $one){
            $today = date('Y-m-d');
            $is_today =  date('Y-m-d',$one['create_date']) == $today;
            $is_yesterday = date('Y-m-d',$one['create_date']) == date('Y-m-d', strtotime('-1 day'));
            ?>
            <?php
            if(!$is_today
                && (!isset($news[$key-1]) || round($news[$key-1]['create_date']/(60*60*24)-$one['create_date']/(60*60*24)) >= 1)
            ){
                ?>
                <section class="olderNews">
                <h3><?php if($is_yesterday){echo Yii::t('frontend', 'Вчора');}else{echo date('d.m.y', $one['create_date']);}?></h3>
                <?php
            }
            ?>
            <section class="zhitomirToday-item clear">
                <?php if($is_today){
                    ?>
                    <time datetime="<?php echo date('H:i',$one['create_date'])?>"><?php echo date('H:i',$one['create_date'])?></time>
                    <?php
                }
                ?>
                <div class="zhitomirToday-wrapContent">
                    <p>
                        <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl($category->translit.'/'.$one['translit'])?>"
                           title="<?php echo $one['t']['title']?>">
                            <?php echo $one['t']['title']?>
                        </a>
                        <?php if($one['source']){
                           ?>
                            <a href="<?php echo $one['source']['source']['link']?>"
                               title="<?php echo $one['source']['source']['t']['name']?>"
                               class="zhitomirToday-magazine">
                                <?php echo $one['source']['source']['t']['name']?>
                            </a>
                        <?php
                        }?>
                    </p>
                </div>
            </section>
            <?php
            if(!$is_today
                && (!isset($news[$key-1]) || round($news[$key-1]['create_date']/(60*60*24)-$one['create_date']/(60*60*24)) >= 1)
            ){
                ?>
                </section>
                <?php
            }
                ?>
            <?php
        }?>
        <?php
        if($pages->totalCount > 15){
            ?>
            <div class="zhitomirToday-pages">
                <span><?php echo Yii::t('frontend', 'Сторінки')?>:</span>
                <?php
                echo LinkPager::widget([
                    'pagination' => $pages,
                    'activePageCssClass' => 'activePage',
                    'maxButtonCount' => '3',

                    'nextPageLabel' => Yii::t('frontend', 'наступна').'→',
                ]);
                ?>
            </div>
            <?php
        }
        ?>


    </div>
    <?php
}