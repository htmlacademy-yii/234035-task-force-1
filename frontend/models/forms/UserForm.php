<?php

namespace frontend\models\forms;

use Yii;
use yii\base\Model;

class UserForm extends Model
{
    public $categories;
    public $free_now;
    public $online_now;
    public $is_opinions;
    public $in_favorites;
    public $search;

    public function attributeLabels()
    {
        return [
            'categories' => '',
            'free_now' => 'Сейчас свободен',
            'online_now' => 'Сейчас онлайн',
            'is_opinions' => 'Есть отзывы',
            'in_favorites' => 'В избранном',
            'search' => 'Поиск по имени',
        ];
    }

    public function rules()
    {
        return [
            [['categories', 'free_now', 'online_now', 'is_opinions', 'in_favorites', 'search'], 'safe'],
        ];
    }
}
