<?php
use yii\helpers\VarDumper;
use frontend\smile\components\ImageHelper;
if($news){
    ?>
    <div class="famousPeople clear">
        <?php foreach($news as $one){
            $name = $one['t']['first_name'];
            if($one['t']['second_name']){
                $name .= ' '.$one['t']['second_name'];
            }
            ?>
            <section>
                <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('/point-of-view/'.$one['translit'])?>" title="<?php echo $name?>">
                    <figure>
                        <?php if($one['photo']){
                            ?>
                            <img src="<?php echo ImageHelper::buildNewsPhotoPath($one['photo'], $one['id'])?>" alt="<?php echo $name?>">
                            <?php
                        }?>
                        <figcaption>
                            <h2><?php echo $name ?></h2>
                            <p><?php echo $one['t']['title']?></p>
                            <?php
                            if($one['t']['annotation']){
                                ?>
                                <div <?php echo $one['color']?'style="background:'.$one['color'].'"':''?>
                                    class="famousPeopleGo"><?php echo $one['t']['annotation']?></div>
                                <?php
                            }
                            ?>
                        </figcaption>
                    </figure>
                </a>
            </section>
        <?php }?>
    </div>
    <?php
}