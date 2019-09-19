<?php
/**
 * Created by Artyom Manchenkov
 * artyom@manchenkoff.me
 * manchenkoff.me © 2019
 */
namespace app\commands;
use app\models\User;
use yii\console\Controller;

class AppController extends Controller
{
    public function actionUsers()
    {
        $admin = new User([
            'username' => 'admin',
            //'password_hash' => '',
            //'auth_key' => '',
            'access_token' => 'test',
            'created_at' => time(),
            'updated_at' => time(),
        ]);
        $admin->generateAuthKey();
        $admin->password = '123123123'; // $this->setPassword('123123123')
        $admin->save();
    }
    public function actionActivities()
    {
        // первые 10 событий
    }
}
