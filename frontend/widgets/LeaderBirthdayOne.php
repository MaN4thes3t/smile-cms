<?php

namespace frontend\widgets;

use backend\modules\leader\models\Leader;
use yii;
use yii\base\Widget;
use yii\helpers\ArrayHelper;

class LeaderBirthdayOne extends Widget {

    public $leader;

    public function init()
    {
        $this->leader = Leader::find()
            ->joinWith(['t', 'images'])
            ->andWhere([
                '`leader`.`show`' => 1,
            ])
            ->andWhere('`leader_translate`.`first_name` != ""')
            ->andWhere('`leader_translate`.`last_name` != ""')
            ->andWhere('`birthday` >= '.mktime(0,0,0))
            ->andWhere('`birthday` <= '.mktime(23,59,59))
            ->distinct()
            ->asArray()
            ->one();
    }
    

    public function run()
    {
        return $this->render('leaderBirthdayOne', [
            'leader'=>$this->leader,
        ]);
    }
}