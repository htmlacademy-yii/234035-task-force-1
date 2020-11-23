<?php
namespace frontend\controllers;

use frontend\models\Tasks;
use yii\web\Controller;

class TasksController extends Controller
{
    public function actionIndex(): string
    {
        $data = (new Tasks())->getData();
        return $this->render('index', ['data' => $data]);
    }
}
