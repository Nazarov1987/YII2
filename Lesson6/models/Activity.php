<?php

namespace app\models;

use yii\db\ActiveRecord;


class Activity extends ActiveRecord
{

        /**
     * Магический метод для получение зависимого объекта из БД
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}