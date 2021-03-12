<?php
namespace frontend\controllers;

use Yii;
use frontend\models\Categories;
use frontend\models\forms\TaskForm;
use frontend\models\Tasks;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

class TasksController extends Controller
{

    public function actionIndex(): string
    {
        $form = new TaskForm();

        if (Yii::$app->request->getIsPost()) {
            $form->load(Yii::$app->request->post());
        }

        $categories = (new Categories())->findAllCategories();
        $data = (new Tasks())->findAllTasks($form);

        return $this->render('index', ['data' => $data, 'categories' => $categories, 'form' => $form]);
    }
}
