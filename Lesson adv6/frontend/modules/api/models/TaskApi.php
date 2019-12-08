<?php

namespace frontend\modules\api\models;

use common\models\Task;

class TaskApi extends Task
{
    public function fields()
    {
        return ['id', 'title', 'description_short' => function($model){
            $shot = substr($this -> description, 0, 50);
            return $shot;
        }];
    }

    public function extrafields()
    {
        return ['projects'];
    }
}