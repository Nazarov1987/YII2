<?php

namespace frontend\modules\api\models;

use common\models\Project;

class ProjectApi extends Project
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
        return ['tasks'];
    }
}