<?php
/**
 * Created by PhpStorm.
 * User: Артём
 * Date: 23.05.2015
 * Time: 14:56
 */
use yii\widgets\LinkPager;
?>
<h1 class="title"><?=Yii::t('frontend','Photo');?></h1>
<div id="photo-list">
    <?php foreach($photos as $photo){
        ?>
        <div class="col-md-3">
            <div class="image-pic">
                <a href="<?='/uploads/Photo/'.$photo->id.'/'.$photo->path?>" class="photo-hover">
                    <img src="<?='/uploads/Photo/'.$photo->id.'/small/'.$photo->path?>"/>
                </a>
            </div>
        </div>
        <?php
    }?>
</div>
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