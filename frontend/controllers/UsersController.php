<?php
namespace frontend\controllers;

use frontend\models\Users;
use yii\web\Controller;

class UsersController extends Controller
{
    public function actionIndex(): string
    {
        $data = (new Users())->findAllUsers();
        return $this->render('index', ['data' => $data]);
    }
}
