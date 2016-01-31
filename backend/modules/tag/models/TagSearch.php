<?php

namespace backend\modules\tag\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\VarDumper;

/**
 * TagSearch represents the model behind the search form about `backend\modules\tag\models\Tag`.
 */
class TagSearch extends Tag
{
    public $text;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['show'],'integer'],
            [['text'],'string'],
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
        $query = Tag::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->getSort()->attributes['text'] = [
            'asc' => ['text' => SORT_ASC],
            'desc' => ['text' => SORT_DESC],
            'default' => SORT_ASC
        ];

        $this->load($params);


        if($this->show != ''){
            $query->andWhere([''.Tag::tableName().'.'.'show' => $this->show]);
        }
        if($this->text){
            $query->joinWith(['t'=>function($q){
                return $q->from(TagTranslate::tableName().' as translate');
            }]);
            $query->andFilterWhere(['like', 'translate.text', $this->text]);
        }

        return $dataProvider;
    }
}
