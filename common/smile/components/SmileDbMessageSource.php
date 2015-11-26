<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace common\smile\components;

use yii\i18n\DbMessageSource;
use Yii;
use yii\base\InvalidConfigException;
use yii\di\Instance;
use yii\helpers\ArrayHelper;
use yii\caching\Cache;
use yii\db\Connection;
use yii\db\Query;
class SmileDbMessageSource extends DbMessageSource
{
    public $multilingualKey = 'id_item';
    protected function loadMessagesFromDb($category, $language)
    {
        $mainQuery = new Query();
        $mainQuery->select(['t1.message message', 't2.translation translation'])
            ->from(["$this->sourceMessageTable t1", "$this->messageTable t2"])
            ->where('t1.id = t2.'.$this->multilingualKey.' AND t1.category = :category AND t2.language = :language')
            ->params([':category' => $category, ':language' => $language]);

        $fallbackLanguage = substr($language, 0, 2);
        if ($fallbackLanguage != $language) {
            $fallbackQuery = new Query();
            $fallbackQuery->select(['t1.message message', 't2.translation translation'])
                ->from(["$this->sourceMessageTable t1", "$this->messageTable t2"])
                ->where('t1.id = t2.'.$this->multilingualKey.' AND t1.category = :category AND t2.language = :fallbackLanguage')
                ->andWhere("t2.'.$this->multilingualKey.' NOT IN (SELECT '.$this->multilingualKey.' FROM $this->messageTable WHERE language = :language)")
                ->params([':category' => $category, ':language' => $language, ':fallbackLanguage' => $fallbackLanguage]);

            $mainQuery->union($fallbackQuery, true);
        }

        $messages = $mainQuery->createCommand($this->db)->queryAll();

        return ArrayHelper::map($messages, 'message', 'translation');
    }
}
