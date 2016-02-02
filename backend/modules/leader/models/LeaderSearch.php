<?php

namespace backend\modules\leader\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\VarDumper;

/**
 * LeaderSearch represents the model behind the search form about `backend\modules\leader\models\Leader`.
 */
class LeaderSearch extends Leader
{
    public $name;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['show'],'integer'],
            [['first_name','birthday','last_name'],'string'],
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
        $query = Leader::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->getSort()->attributes['name'] = [
            'asc' => ['first_name' => SORT_ASC, 'last_name' => SORT_ASC],
            'desc' => ['first_name' => SORT_DESC, 'last_name' => SORT_DESC],
            'default' => SORT_ASC
        ];

        $this->load($params);


        if($this->show != ''){
            $query->andWhere([''.Leader::tableName().'.'.'show' => $this->show]);
        }
        $query->joinWith(['t'=>function($q){
            return $q->from(LeaderTranslate::tableName().' as translate');
        }]);
        if($this->name){

            $query->orFilterWhere(['like', 'translate.first_name', $this->name]);
            $query->orFilterWhere(['like', 'translate.last_name', $this->name]);
        }

        return $dataProvider;
    }
}
