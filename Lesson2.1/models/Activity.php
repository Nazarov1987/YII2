<?php

namespace app\models;

use yii\base\Model;

class Activity extends Model
{
    public $title;
    public $dayStart;
    public $dayEnd;
    public $userId;
    public $description;
    public $reiteration;
}