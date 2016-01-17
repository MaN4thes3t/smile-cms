<?php

namespace backend\modules\news\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\VarDumper;

/**
 * NewsSearch represents the model behind the search form about `backend\modules\news\models\News`.
 */
class NewsSearch extends News
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
        $query = News::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->getSort()->attributes['name'] = [
            'asc' => ['title' => SORT_ASC],
            'desc' => ['title' => SORT_DESC],
            'default' => SORT_ASC
        ];

        $this->load($params);

        $query->joinWith(['translate']);

        if($this->show != ''){
            $query->andWhere([''.News::tableName().'.'.'show' => $this->show]);
        }

        if($this->title){
            $query->andFilterWhere(['like', NewsTranslate::tableName().'.'.'title', $this->title]);
        }

        return $dataProvider;
    }
}
