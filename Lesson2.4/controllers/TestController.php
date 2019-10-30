<?php

namespace app\controllers;

use yii\web\Controller;
use Yii;
use yii\db\Query;
use yii\helpers\VarDumper;

class TestController extends Controller{

    public function actionTest()
    {
    return  Yii::$app->test->test();
    }

    public function actionInsert()
    {
        $testInsert = Yii::$app->db->createCommand()->insert('user',
        ['username'=>'admin',
        'name' => 'Evgeny',
        'password_hash' => '$2y$13$PwXn2ruSRViHiVyOaC8',
        'access_token' => 'hjkl',
        'auth_key' => 'fasdfg',
        'creator_id' => 1,
        'updater_id' => 1,
        'created_at' => 12346757,
        'updated_at' => 24575776,
        ])->execute();

        $testBatchInsert = Yii::$app->db->createCommand()->batchInsert('task',
        ['title','description','creator_id','updater_id','created_at','updated_at'],
        [
            ['first', 'event_one', 1, 1, 113434528, 113434321],
            ['second', 'event_two', 1, 1, 113443554, 113434673],
            ['thid', 'event_three', 1, 1, 113443522, 113434211],
        ])->execute();
        //_end($testBatchInsert);
        //return VarDumper::dumpAsString($test, 5, true);
    }
    public function actionSelect()
    {
        $query = new Query();
        _end($query->from('user')->where('id=1')->one());

        $query = new Query();
        _end($query->from('user')->where('id>1')->orderBy('name')->all());

        $query = new Query();
        _end($query->from('user')->count());
    }
}