<?php

if($categories){
    ?>
    <section class="manyNews clear">
    <?php
    foreach($categories as $category){
        ?>
        <div class="mNews">
            <h2 class="headerMNews">
                <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl($category['translit'])?>"
                   title="<?php echo $category['t']['name']?>"><?php echo $category['t']['name']?></a>
            </h2>
            <div class="clear"></div>
            <div class="mNewsContent">
                <ul>
                    <?php
                    foreach($category['news'] as $news){
                        ?>
                        <li>
                            <div class="data">
                                <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl($category['category']->translit.'/'.$news['translit'])?>"
                                   title="<?php echo $news['t']['title']?>">
                                    <?php echo date('d.m.Y',$news['create_date'])?>
                                </a>
                            </div>
                            <div class="text">
                                    <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl($category['category']->translit.'/'.$news['translit'])?>"
                                       title="<?php echo $news['t']['title']?>">
                                        <?php echo $news['t']['title']?>
                                    </a>
                            </div>
                        </li>
                        <?php
                    }?>
                </ul>
            </div>
        </div>
        <?php
    }
    ?>
    </section>
    <?php
}
?>