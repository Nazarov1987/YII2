<?php

namespace app\models;

use yii\base\Model;

class Day extends Model
{
    public $dayOff = false;
    public $activities = [];
}