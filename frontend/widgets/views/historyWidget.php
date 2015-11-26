<?php
/**
 * @var $this frontend\widgets\TopMenuWidget
 * @var $items backend\modules\page\models\Page;
 */
use yii\helpers\Html;
use yii\helpers\VarDumper;
if($items){
    ?>
    <div class="our_history">
        <div class="our_history_wrapp">
            <div class="history_title">
                <span><?=Yii::t('frontend','Наша')?></span>
                &nbsp;
                <span><?=Yii::t('frontend','історія')?></span>
            </div>
            <div class="history_line"></div>
            <div class="history_data">
                <table>
                    <?php foreach($items as $item){
                        $date_m = date('d.m',strtotime($item->date));
                        $date_y = date('Y',strtotime($item->date));;
                        ?>
                        <tr>
                            <td class="date"><span><?=$date_m?></span><br/><span><?=$date_y?></span></td>
                            <td class="short_text"><?=$item->t->text?></td>
                        </tr>
                        <?php
                    }?>
                </table>
            </div>
        </div>
    </div>
    <?php
}
