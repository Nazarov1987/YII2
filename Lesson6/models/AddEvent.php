<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * Модель - Событие
 * @package app\models
 * @property-read User $user
 */

class AddEvent extends ActiveRecord
{
    public static function tableName()
    {
        return 'event-tb2';
    }
    public function attributeLabels()
    {
        return [
            'title_fd' => 'Название события',
            'day_start_fd' => 'Начало события',
            'day_end_fd' => 'Окончание события',
            'user_id_fd' => 'Пользователь',
            'description' => 'Описание события',
            'repeat_fd' => 'Повторение события',
            'blocked_fd' => 'Событие на весь день'
        ];
    }
    public function rules()
    {
        return [
            [['title_fd','day_start_fd', 'user_id_fd'], 'required'],
            [['user_id_fd'], 'integer'],
           // [['day_start_fd', 'day_end_fd'], 'date'],
            ['day_end_fd', 'default', 'value' => function () {
                return $this->day_start_fd;
            }],
            [['title_fd'], 'string', 'min' => 20, 'max' => 200],
            [['description'], 'string', 'min' => 20, 'max' => 200],
        ];
    }
    public function getUser() // $model->user
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}