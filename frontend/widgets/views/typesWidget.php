<?php
/**
 * @var $this frontend\widgets\TopMenuWidget
 * @var $items backend\modules\page\models\Page;
 */
use yii\helpers\Html;
use yii\helpers\VarDumper;
if($items){
    ?>
    <div class="types_title">
<!--        <span class="big_number">--><?//=count($items)?><!--</span>-->
        <?php if($page->id == \backend\modules\page\models\Page::PAGE_RESTORAN){
            ?>
            <?=Yii::t('frontend','наші зали')?>
            <?php
        }?>
        <?php if($page->id == \backend\modules\page\models\Page::PAGE_HOTEL){
            ?>
            <?=Yii::t('frontend','типи номерів')?>
        <?php
        }?>
    </div>
    <?php
    if(count($items)>4){
        $items_new = array_chunk($items,(count($items)/2));
        foreach($items_new as $key=>$items){
            ?>
            <div class="types_items">
            <?php
            foreach($items as $item){
                if($item->attach){
                    ?>
                    <div class="one_item">
                        <div class="image">
                            <a href="<?=Yii::$app->urlManager->createAbsoluteUrl($item->translit)?>" class="image_table">
                                <div class="image_table_cell">
                                    <img src="/uploads/Page/<?=$item->id?>/big_gallery/<?=$item->attach[0]->path?>">
                                </div>
                            </a>
                            <div class="figure">
                                <div class="hover_block"></div>
                                <div class="two_red_ball"></div>
                                <div class="type_name">
                                    <span><?=$item->t->name?></span>
                                </div>
                            </div>
                            <div class="one_red_ball"></div>
                        </div>
                        <div data-id="<?=$key?>" class="one_item_descr">
                            <?=$item->t->description?>
                        </div>
                    </div>
                <?php
                }
            }
            ?>
            </div>
            <div id="description_<?=$key?>" class="description"></div>
            <?php
        }
    }else{
        ?>
        <div class="types_items">
        <?php
        foreach($items as $item){
            if($item->attach){
                ?>
                <div class="one_item">
                    <div class="image">
                        <a href="<?=Yii::$app->urlManager->createAbsoluteUrl($item->translit)?>" class="image_table">
                            <div class="image_table_cell">
                                <img src="/uploads/Page/<?=$item->id?>/big_gallery/<?=$item->attach[0]->path?>">
                            </div>
                        </a>
                        <div class="figure">
                            <div class="hover_block"></div>
                            <div class="two_red_ball"></div>
                            <div class="type_name">
                                <span><?=$item->t->name?></span>
                            </div>
                        </div>
                        <div class="one_red_ball"></div>
                    </div>
                    <div data-id="1" class="one_item_descr">
                        <?=$item->t->description?>
                    </div>
                </div>
            <?php
            }
        }
        ?>
        </div>
        <div id="description_1" class="description"></div>
        <?php
    }
}
