<?php

namespace frontend\widgets;

use backend\modules\advice\models\Advice;
use yii;
use yii\base\Widget;
use yii\helpers\ArrayHelper;

class AdviceMain extends Widget {

    public $advices;


    public function init()
    {
        $this->advices = Advice::find()
            ->joinWith(['t'])
            ->andWhere([
                '`advice`.`show`' => 1,
            ])
            ->distinct()
            ->limit(6)
            ->orderBy(new yii\db\Expression('rand()'))
            ->asArray()
            ->all();
//        echo '<pre>';
//        var_dump($this->advices);
//        echo '</pre>';
//        die();
    }

    public function run()
    {
        return $this->render('adviceMain', [
            'advices'=>$this->advices,
        ]);
    }
}