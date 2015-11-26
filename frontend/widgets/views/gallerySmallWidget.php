<?php
/**
 * @var $this frontend\widgets\TopMenuWidget
 * @var $items backend\modules\page\models\Page;
 */
use yii\helpers\Html;
use yii\helpers\VarDumper;
if($page->attach){
    ?>
    <div class="small_images_block">
        <ul>
            <?php foreach($page->attach as $key=>$attach){
                ?>
                <li <?php if($key == 0){?>class="active"<?php }?>>
                    <div>
                        <img src="<?='/uploads/Page/'.$page->id.'/little_gallery/'.$attach->path?>">
                    </div>
                </li>
            <?php
            }?>
        </ul>
        <div class="slider_wrapp">
            <input type="range" min="0" max="0" step="5" value="10">
        </div>
        <?php if($page->t->description){
            ?>
            <div class="wrapper">
                <div class="gallery_description">
                    <?=$page->t->description?>
                </div>
            </div>

        <?php
        }?>
    </div>
    <?php
}
