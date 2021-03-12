<?php
namespace frontend\controllers;

use Yii;
use frontend\models\Categories;
use frontend\models\forms\UserForm;
use frontend\models\Users;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

class UsersController extends Controller
{

    public function actionIndex(): string
    {
        $form = new UserForm();

        if (Yii::$app->request->getIsPost()) {
            $form->load(Yii::$app->request->post());
        }

        $categories = (new Categories())->findAllCategories();
        $data = (new Users())->findAllUsers($form);

        return $this->render('index', ['data' => $data, 'categories' => $categories, 'form' => $form]);
    }
}
