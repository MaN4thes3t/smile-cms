<?php
/**
 * @var $this frontend\widgets\BreadcrumbsWidget
 */
use yii\helpers\Html;
use yii\helpers\VarDumper;
if($pages){
    $end = end($pages);
    reset($pages);
    if($main){
        ?>
        <?=Html::a($main->t->name,Yii::$app->urlManager->createAbsoluteUrl(['/']));?>
        -
        <?php
    }
    $url = '/';
    foreach($pages as $page){
        $url = $url.$page->translit.'/';
//        if($end->id != $page->id){
            ?>
            <?=Html::a($page->t->name,Yii::$app->urlManager->createAbsoluteUrl([$url]))?>
            <?php
        if($end->id != $page->id){
            ?>
            -
            <?php
        }
//        }else{
//            ?>
<!--            <span>--><?//=$page->t->name?><!--</span>-->
<!--            --><?php
//        }
    }
}
