<?php
/**
 * @var $this frontend\widgets\TopMenuWidget
 * @var $items backend\modules\page\models\Page;
 */
use yii\helpers\Html;
use yii\helpers\VarDumper;
foreach($items as $item){
    ?>
    <li>
        <a href="<?=Yii::$app->urlManager->createAbsoluteUrl($item->translit)?>"><?=$item->t->name?></a>
    </li>
    <?php
    if($item->main_page){
        ?>
        <li>
            <a href="<?=Yii::$app->urlManager->createAbsoluteUrl('/news')?>"><?=Yii::t('frontend','Новости')?></a>
        </li>
        <?php
    }
}
?>
<li>
    <a href="<?=Yii::$app->urlManager->createAbsoluteUrl('/comitet')?>"><?=Yii::t('frontend','Оргкомитет')?></a>
</li>
<li>
    <a href="<?=Yii::$app->urlManager->createAbsoluteUrl('/partners')?>"><?=Yii::t('frontend','Партнеры')?></a>
</li>
<li>
    <a href="<?=Yii::$app->urlManager->createAbsoluteUrl('/photo')?>"><?=Yii::t('frontend','Фото')?></a>
</li>
<li>
    <a href="<?=Yii::$app->urlManager->createAbsoluteUrl('/video')?>"><?=Yii::t('frontend','Видео')?></a>
</li>
<!--    <li class="active"><a href="/main.html">home</a></li>-->
<!--    <li><a href="/news.html">news</a></li>-->
<!--    <li><a href="#">competitions</a></li>-->
<!--    <li><a href="#">participants</a></li>-->
<!--    <li><a href="#">results</a></li>-->
<!--    <li><a href="/organizing_committee.html">organizing committee</a></li>-->
<!--    <li><a href="/partners.html">partners</a></li>-->
<!--    <li><a href="/photo.html">photo</a></li>-->
<!--    <li><a href="/video.html">video</a></li>-->
