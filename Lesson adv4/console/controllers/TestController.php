<?php
namespace console\controllers;

use yii\console\Controller;
use yii\helpers\Console;
/**
 * Test action
 * 
 * @param $param
 */
class TestController extends Controller
{
    public function actionIndex($param)
    {
        $this->stdout($param, Console::BG_BLACK, Console::FG_YELLOW);
    }
}
