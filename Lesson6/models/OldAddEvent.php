<?php

namespace app\models;

use yii\base\Model;

class AddEvent extends Model
{
    public $title;
    public $dayStart;
    public $dayEnd;
    public $userId;
    public $description;
    public $repeat;
    public $blocked;

    public function attributeLabels()
    {
        return [
            'title' => 'Название события',
            'dayStart' => 'Начало события',
            'dayEnd' => 'Окончание события',
            'userId' => 'Пользователь',
            'description' => 'Описание события',
            'repeat' => 'Повторение события',
            'blocked' => 'Событие на весь день'
        ];
    }
    public function rules()
    {
        return [
            [['title','dayStart', 'dayEnd', 'userId'], 'required'],
            [['dayStart', 'dayEnd'], 'date', 'format' => 'php:d-m-y'],
            [['userId'], 'integer'],
            [['title'], 'string', 'min' => 20, 'max' => 200],
        ];
    }
}