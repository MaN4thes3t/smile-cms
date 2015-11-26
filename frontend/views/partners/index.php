<?php
/**
 * Created by PhpStorm.
 * User: Артём
 * Date: 23.05.2015
 * Time: 15:36
 */
?>
<h1 class="title"><?=Yii::t('frontend','Partners')?></h1>
<?php foreach($partners as $partner){
    ?>
    <div class="col-sm-3 partner">
        <div class="partner-pic">
            <a href="<?=$partner->link?>" class="partner-hover">
                <img src="<?='/uploads/Partners/'.$partner->id.'/'.$partner->img?>"/>
            </a>
        </div>
    </div>
    <?php
}?>
