<?php

namespace backend\modules\newscategory\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\VarDumper;

/**
 * NewscategorySearch represents the model behind the search form about `backend\modules\newscategory\models\Newscategory`.
 */
class NewscategorySearch extends Newscategory
{
    public $name;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['show','show_in_menu','show_in_left_menu','id'],'integer'],
            [['name'],'string'],
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
        $query = Newscategory::find();

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
            $query->andWhere([''.Newscategory::tableName().'.'.'show' => $this->show]);
        }

        if($this->show_in_menu != ''){
            $query->andWhere([''.Newscategory::tableName().'.'.'show_in_menu' => $this->show_in_menu]);
        }

        if($this->show_in_left_menu != ''){
            $query->andWhere([''.Newscategory::tableName().'.'.'show_in_left_menu' => $this->show_in_left_menu]);
        }
        $query->joinWith(['t'=>function($q){
            return $q->from(NewscategoryTranslate::tableName().' as translate');
        }]);
        if($this->name){

            $query->andFilterWhere(['like', 'translate.name', $this->name]);
        }

        return $dataProvider;
    }
}
