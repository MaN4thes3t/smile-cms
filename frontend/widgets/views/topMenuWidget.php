<?php
/**
 * @var $this frontend\widgets\TopMenuWidget
 * @var $items backend\modules\page\models\Page;
 */
use yii\helpers\Html;
use yii\helpers\VarDumper;
if($items){
    if(is_array($pages))
    $page = current($pages);
    else
        $page = $pages;
?>
    <menu>
        <?php
        foreach($items as $item){
            ?>
            <li <?php if(isset($page->id) && $page->id == $item->id){?>class="current"<?php }?>><?=Html::a($item->t->name,Yii::$app->urlManager->createAbsoluteUrl([$item->translit]),[
                    'data-id'=>$item->id,
                    'class'=>$item->type==\backend\modules\page\models\Page::TYPE_STANDART?'type_standart':''
                ])?></li>
            <?php
        }
        ?>
        <li <?php if($page == 'services'){?>class="current"<?php }?>><?=Html::a(Yii::t('frontend','Сервіси'),Yii::$app->urlManager->createAbsoluteUrl(['services']))?></li>
        <li <?php if($page == 'news'){?>class="current"<?php }?>><?=Html::a(Yii::t('frontend','Новини'),Yii::$app->urlManager->createAbsoluteUrl(['news']))?></li>
        <li <?php if($page == 'contacts'){?>class="current"<?php }?>><?=Html::a(Yii::t('frontend','Контакти'),Yii::$app->urlManager->createAbsoluteUrl(['contacts']))?></li>
    </menu>
<?php
}
