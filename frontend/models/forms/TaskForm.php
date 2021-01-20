<?php

namespace frontend\models\forms;

use Yii;
use yii\base\Model;

class TaskForm extends Model
{
    public $categories;
    public $no_replies;
    public $remote_work;
    public $period;
    public $search;

    public function attributeLabels()
    {
        return [
            'categories' => '',
            'no_replies' => 'Без отликов',
            'remote_work' => 'Удаленная работа',
            'period' => 'Период',
            'search' => 'Поиск по названию',
        ];
    }

    public function rules()
    {
        return [
            [['categories', 'no_replies', 'remote_work', 'period', 'search'], 'safe'],
        ];
    }
}
