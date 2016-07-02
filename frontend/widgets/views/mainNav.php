
<?php
use yii\helpers\VarDumper;
if($pages){
    ?>
    <nav class="<?php echo $footer?'fMainNav':'mainNav'?>">
        <ul class="clear">
            <?php foreach($pages as $page){
                ?>
                <li>
                    <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('/page/'.$page['translit'])?>">
                        <?php echo $page['t']['title']?>
                    </a>
                </li>
                <?php
            }?>
<!--            <li><a href="#">Про нас</a></li>-->
<!--            <li><a href="#">РЕДАКЦІЯ</a></li>-->
<!--            <li><a href="#">Контакти</a></li>-->
<!--            <li><a href="#">Реклама</a></li>-->
        </ul>
    </nav>
    <?php
}