<?php
/**
 * @var $this frontend\widgets\TopMenuWidget
 * @var $items backend\modules\page\models\Page;
 */
use yii\helpers\Html;
use yii\helpers\VarDumper;
if($items){

    if(is_array($pages)){
        $c_page = current($pages);
        reset($pages);
        $page = next($pages);
    }

?>
    <?php foreach($items as $item){
//        echo $item->id;
//        echo $c_page->id;
        if($item['children']){
            ?>
            <div id="page_<?=$item['id']?>" class="one_second_menu <?php if($c_page->id == $item['id']){?>current<?php }?>">
                <menu>
                    <?php
                    foreach($item['children'] as $second){
                        ?>
                        <li <?php if(isset($page) && $page->id == $second['id']){?>class="current"<?php }?>><?=Html::a($second['t']['name'],Yii::$app->urlManager->createAbsoluteUrl([$item['translit'].'/'.$second['translit']]))?></li>
                    <?php
                    }
                    ?>
                </menu>
            </div>
            <?php
        }
    }?>
<?php
}
