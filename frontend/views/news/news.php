<?php
/**
 * Created by PhpStorm.
 * User: Артём
 * Date: 25.04.2015
 * Time: 21:11
 */
use yii\helpers\Html;
use yii\helpers\VarDumper;
?>
<div class="date-title"><?=date('d/m/y',strtotime($news->date))?></div>
<h1 class="title"><?=$news->t->title?></h1>
<?php if($news->img){
    ?>
    <img class="content-img" src="<?='/uploads/News/'.$news->id.'/'.$news->img?>"/>
    <?php
}?>
<div id="inner_content">
    <?=$news->t->text?>
</div>