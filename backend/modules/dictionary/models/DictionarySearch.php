<?php

namespace backend\modules\dictionary\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\VarDumper;

/**
 * DictionarySearch represents the model behind the search form about `backend\modules\dictionary\models\Dictionary`.
 */
class DictionarySearch extends Dictionary
{
    public $translation;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category','translation','message'],'string'],
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
        $query = Dictionary::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $dataProvider->getSort()->attributes['translation'] = [
            'asc' => ['translation' => SORT_ASC],
            'desc' => ['translation' => SORT_DESC],
            'default' => SORT_ASC
        ];
        $this->load($params);
        $query->joinWith(['t'=>function($q){
            return $q->from(DictionaryTranslate::tableName().' as translate');
        }]);
        if($this->translation){
            $query->andFilterWhere(['like', 'translate.translation', $this->translation]);
        }
        if($this->message){
            $query->andWhere(['like', ''.Dictionary::tableName().'.'.'message', $this->message]);
        }

        if($this->category != ''){
            $query->andWhere([''.Dictionary::tableName().'.'.'category' => $this->category]);
        }

        return $dataProvider;
    }
}
