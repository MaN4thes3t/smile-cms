<?php
/**
 * @var $this frontend\widgets\TopMenuWidget
 * @var $items backend\modules\page\models\Page;
 */
use yii\helpers\Html;
use yii\helpers\VarDumper;
if($pages_gallery){
    ?>
    <div class="circles_wrapp">
        <?php foreach($pages_gallery as $p){
            ?>
            <a href="<?=Yii::$app->urlManager->createAbsoluteUrl([$p->translit])?>" class="one_item_circle <?php if($page->id == $p->id){?>active<?php }?>">
                <div class="table_block">
                    <div class="left_img">
                        <div>
                            <img class="active" src="<?='/uploads/Page/'.$p->id.'/'.$p->icon?>">
                            <img class="hover" src="<?='/uploads/Page/'.$p->id.'/'.$p->icon_h?>">
                        </div>
                    </div>
                    <div class="right_text">
                        <span><?=$p->t->name?></span>
                    </div>
                </div>
            </a>
            <?php
        }?>
    </div>
    <?php
}
if($page->attach){
    ?>
    <div class="big_imgages_for_gal">
        <ul>
            <?php foreach($page->attach as $key=>$attach){
                ?>
                <li <?php if($key == 0){?>class="active"<?php }?>>
                    <a>
                        <img src="<?='/uploads/Page/'.$page->id.'/big_gallery/'.$attach->path?>">
                    </a>
                </li>
                <?php
            }?>
        </ul>
    </div>
    <?php
}
