<?php

namespace app\components;

use yii\base\Component as YiiComponent;


class TestService extends YiiComponent
{
    public $testService = 'Тестируем класс TestService';

    public function test(){
        return $this->testService;
    }
}