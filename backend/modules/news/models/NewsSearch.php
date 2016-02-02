<?php

namespace backend\modules\news\models;

use common\models\User;
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
    public $types;
    public $categories;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['show','id'],'integer'],
            [['create_date','end_date','user_id','title'],'string'],
            [['types','categories','views','comments'],'default'],
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

        $this->load($params);
        $dataProvider->getSort()->attributes['title'] = [
            'asc' => ['translate.title' => SORT_ASC],
            'desc' => ['translate.title' => SORT_DESC],
            'default' => SORT_ASC
        ];

        if($this->show != ''){
            $query->andWhere([''.News::tableName().'.'.'show' => $this->show]);
        }
        $query->joinWith(['t'=>function($q){
            return $q->from(NewsTranslate::tableName().' as translate');
        }]);
        if($this->title){

            $query->andFilterWhere(['like', 'translate.title', $this->title]);
        }

        if($this->types){
            $query->joinWith(['types'=>function($q){
               return $q->from(Type::tableName().' as types');
            }]);
            $query->andWhere(['types.type_code'=>$this->types]);
        }

        if($this->categories){
            $query->joinWith(['types'=>function($q){
                return $q->from(Category::tableName().' as categories');
            }]);
            $query->andWhere(['categories.id_category'=>$this->categories]);
        }

        if($this->create_date){
            if($this->create_date['from']){
                $query->andFilterWhere(['>=', ''.News::tableName().'.'.'create_date', strtotime($this->create_date['from'])]);
            }
            if($this->create_date['to']){
                $query->andFilterWhere(['<=', ''.News::tableName().'.'.'create_date', strtotime($this->create_date['to'])]);
            }
        }
        if($this->end_date){
            if($this->end_date['from']){
                $query->andFilterWhere(['>=', ''.News::tableName().'.'.'end_date', strtotime($this->end_date['from'])]);
            }
            if($this->end_date['to']){
                $query->andFilterWhere(['<=', ''.News::tableName().'.'.'end_date', strtotime($this->end_date['to'])]);
            }
        }
        if($this->views){
            if($this->views['from']){
                $query->andFilterWhere(['>=', ''.News::tableName().'.'.'views', $this->views['from']]);
            }
            if($this->views['to']){
                $query->andFilterWhere(['<=', ''.News::tableName().'.'.'views', $this->views['to']]);
            }
        }
        if($this->comments){
            if($this->comments['from']){
                $query->andFilterWhere(['>=', ''.News::tableName().'.'.'comments', $this->comments['from']]);
            }
            if($this->comments['to']){
                $query->andFilterWhere(['<=', ''.News::tableName().'.'.'comments', $this->comments['to']]);
            }
        }
        return $dataProvider;
    }
}
