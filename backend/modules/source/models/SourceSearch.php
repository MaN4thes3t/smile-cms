<?php

namespace backend\modules\source\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\VarDumper;

/**
 * SourceSearch represents the model behind the search form about `backend\modules\source\models\Source`.
 */
class SourceSearch extends Source
{
    public $name;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['show'],'integer'],
            [['name','link'],'string'],
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
        $query = Source::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->getSort()->attributes['name'] = [
            'asc' => ['name' => SORT_ASC],
            'desc' => ['name' => SORT_DESC],
            'default' => SORT_ASC
        ];

        $this->load($params);


        if($this->show != ''){
            $query->andWhere([''.Source::tableName().'.'.'show' => $this->show]);
        }
        $query->joinWith(['t'=>function($q){
            return $q->from(SourceTranslate::tableName().' as translate');
        }]);
        if($this->name){
            $query->andFilterWhere(['like', 'translate.name', $this->name]);
        }
        if($this->link){
            $query->andFilterWhere(['like', ''.Source::tableName().'.'.'link', $this->link]);
        }

        return $dataProvider;
    }
}
