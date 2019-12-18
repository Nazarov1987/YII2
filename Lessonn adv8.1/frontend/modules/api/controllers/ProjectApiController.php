<?php

namespace frontend\modules\api\controllers;

use yii\rest\ActiveController;
use frontend\modules\api\models\ProjectApi;

class ProjectApiController extends  ActiveController
{
    public $modelClass = ProjectApi::class;
}