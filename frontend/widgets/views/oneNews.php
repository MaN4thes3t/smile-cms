
<?php
use yii\helpers\VarDumper;
use frontend\smile\components\ImageHelper;
if($news){
    ?>
    <article class="blockForBlog">
        <section class="mainBlockForBlog">

        </section>
        <section class="textBlog">
            <div class="clear"></div>
            <div class="photoVideoSimply">
                <?php echo \frontend\widgets\PhotoNewsOne::widget()?>
                <?php echo \frontend\widgets\VideoNewsOne::widget()?>
            </div>
        </section>

        <aside class="insideInfo">
            <?php echo \frontend\widgets\LeaderBirthdayOne::widget()?>
            <?php echo \frontend\widgets\FocusOfTheWeekOne::widget()?>
            <?php echo \frontend\widgets\InterviewOne::widget()?>
            <?php echo \frontend\widgets\AdviceMain::widget()?>
        </aside>
    </article>
    <?php
}