<?php
/**
 * Created by PhpStorm.
 * User: Артём
 * Date: 25.04.2015
 * Time: 21:11
 */
use yii\helpers\Html;
use yii\helpers\VarDumper;
use yii\widgets\LinkPager;
$this->title = Yii::t('frontend','News');
?>
<div id="news-wrapper">
    <?php for($i=0;$i<3;$i++){
        if(isset($news[$i])) {
            ?>
            <div class="top-news">
                <div class="picture-of-new">
                    <?php if($news[$i]->img){
                        ?>
                        <img src="<?='/uploads/News/'.$news[$i]->id.'/'.$news[$i]->img?>" />
                        <?php
                    }?>
                </div>
                <div class="news-description">
                    <a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['/news/'.$news[$i]->id])?>" class="more"><?=Yii::t('frontend','more info')?></a>
                    <p class="news-date"><?=date('d/m/y',strtotime($news[$i]->date))?></p>
                    <p class="news-name"><?=$news[$i]->t->title?></p>
                    <div class="news-text">
                        <?=$news[$i]->t->text?>
                    </div>
                </div>
            </div>
            <?php
        }
    }?>
    <?php for($i=3;$i<6;$i++){
        if(isset($news[$i])) {
            ?>
            <div class="second-news col-md-4">
                <div class="picture-of-new">
                    <a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['/news/'.$news[$i]->id])?>">
                        <?php if($news[$i]->img){
                            ?>
                            <img src="<?='/uploads/News/'.$news[$i]->id.'/'.$news[$i]->img?>" />
                        <?php
                        }?>
                    </a>
                </div>
                <a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['/news/'.$news[$i]->id])?>" class="news-description">
                    <p class="news-date"><?=date('d/m/y',strtotime($news[$i]->date))?></p>
                    <p class="news-name"><?=$news[$i]->t->title?></p>
                </a>
            </div>
        <?php
        }
    }?>
    <?php for($i=6;$i<9;$i++){
        if(isset($news[$i])) {
            ?>
            <div class="third-news col-md-4">
                <p class="news-date"><?=date('d/m/y',strtotime($news[$i]->date))?></p>
                <a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['/news/'.$news[$i]->id])?>" class="news-description">
                    <p class="news-name"><?=$news[$i]->t->title?></p>
                </a>
            </div>
        <?php
        }
    }?>
<?php
    ?>
    <div class="pagination_container">
        <div class="pagination_container_2">
           <?php
            echo LinkPager::widget([
                'pagination' => $pages,
                'maxButtonCount'=>7,
                'nextPageLabel'=>'',
                'prevPageLabel'=>'',
            ]);
        ?>
        </div>
    </div>
