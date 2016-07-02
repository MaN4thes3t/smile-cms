<?php

namespace frontend\widgets;

use backend\modules\news\models\News;
use backend\modules\page\models\Page;
use yii;
use yii\base\Widget;
use yii\helpers\ArrayHelper;

class WeatherBlock extends Widget {


    public function init()
    {
    }

    public function run()
    {
        return $this->render('weatherBlock', [
        ]);
    }
}