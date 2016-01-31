<?php

namespace backend\modules\language\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\VarDumper;

/**
 * LanguageSearch represents the model behind the search form about `backend\modules\language\models\Language`.
 */
class LanguageSearch extends Language
{
    public $translate;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['is_default'],'integer'],
            [['show'],'integer'],
            [['translate'],'string'],
            [['code'],'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Language::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);
        if($this->translate){
            $query->joinWith(['t'=>function($q){
                return $q->from(LanguageTranslate::tableName().' as translate');
            }]);
            $query->andWhere(['like', 'translate.translate', $this->translate]);
        }

        if($this->code){
            $query->andWhere(['like', ''.Language::tableName().'.'.'code', $this->code]);
        }

        if($this->is_default != ''){
            $query->andWhere([''.Language::tableName().'.'.'is_default' => $this->is_default]);
        }
        if($this->show != ''){
            $query->andWhere([''.Language::tableName().'.'.'show' => $this->show]);
        }

        return $dataProvider;
    }
}
