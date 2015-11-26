<?php

namespace backend\modules\advice\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\VarDumper;

/**
 * AdviceSearch represents the model behind the search form about `backend\modules\advice\models\Advice`.
 */
class AdviceSearch extends Advice
{
    public $title;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['show'],'integer'],
            [['title'],'string'],
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
        $query = Advice::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->getSort()->attributes['title'] = [
            'asc' => ['title' => SORT_ASC],
            'desc' => ['title' => SORT_DESC],
            'default' => SORT_ASC
        ];

        $this->load($params);

        $query->joinWith(['translate']);

        if($this->show != ''){
            $query->andWhere([''.Advice::tableName().'.'.'show' => $this->show]);
        }

        if($this->title){
            $query->andFilterWhere(['like', AdviceTranslate::tableName().'.'.'title', $this->title]);
        }

        return $dataProvider;
    }
}
