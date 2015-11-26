<?php
/**
 * @var $this frontend\widgets\TopMenuWidget
 * @var $items backend\modules\page\models\Page;
 */
use yii\helpers\Html;
use yii\helpers\VarDumper;
if($items){
    ?>
        <div class="hidden_block">
            <div class="scrolling_block">
                <?php foreach($items as $item){
                    ?>
                    <div class="one_albom">
                        <div class="table">
                            <div class="left_img">
                                <a href="<?=Yii::$app->urlManager->createAbsoluteUrl($item->translit)?>">
                                    <img src="<?='/uploads/Page/'.$item->id.'/small/'.$item->attach[0]->path?>">
                                </a>
                            </div>
                            <div class="center_name">
                                <a href="<?=Yii::$app->urlManager->createAbsoluteUrl($item->translit)?>" ><?=$item->t->name?></a>
                            </div>
                        </div>
                        <div class="all_photo_link">
                            <a href="<?=Yii::$app->urlManager->createAbsoluteUrl($item->translit)?>"><?=Yii::t('frontend','Всі фото')?></a>
                        </div>
                    </div>
                    <?php
                }?>
            </div>
        </div>
    <?php
}
