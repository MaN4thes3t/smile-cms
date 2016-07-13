
<?php
use yii\helpers\VarDumper;
use frontend\smile\components\ImageHelper;
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
            if(isset($news[$key-1])){
                if(!$is_today
                    && round($news[$key-1]['create_date']/(60*60*24)-$one['create_date']/(60*60*24)) >= 1
                ){
                    ?>
                    <section class="olderNews">
                    <h3><?php if($is_yesterday){echo Yii::t('frontend', 'Вчора');}else{echo date('d.m.y', $one['create_date']);}?></h3>
                    <?php
                }
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
                        <a href="#"
                           title="<?php echo $one['t']['title']?>">
                            <?php echo $one['t']['title']?>
                        </a>
                        <?php if($one['sources']){
                           ?>
                            <a href="<?php echo $one['sources']['source']['link']?>"
                               title="<?php echo $one['sources']['source']['t']['name']?>"
                               class="zhitomirToday-magazine">
                                <?php echo $one['sources']['source']['t']['name']?>
                            </a>
                        <?php
                        }?>
                    </p>
                </div>
            </section>
            <?php
        if(isset($news[$key-1])){
            if(!$is_today
                && date('d', date('Y-m-d',$news[$key-1]['create_date'])) - date('d', date('Y-m-d',$one['create_date']))
            ) {
                ?>
                </section>
                <?php
            }
                }
                ?>
            <?php
        }?>
        <div class="zhitomirToday-pages">
            <span>Сторінки:</span>
            <ul class="">
                <li class="activePage"><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li>...</li>
                <li><a href="#">25</a></li>
                <li><a href="#">26</a></li>
                <li><a href="#" class="nextPage">наступна→</a></li>
            </ul>
        </div>
    </div>
    <?php
}