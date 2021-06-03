<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\FoodIngredient;
use app\models\Ingredient;
use yii\helpers\ArrayHelper;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $data = Ingredient::find()->where(['active' => 1])->select(['title', 'id'])->asArray()->all();

        $data = $this->arrayMultiToOne($data);

        $search = Yii::$app->request->get('search');

        if ($search) {
            $searchResults = $this->getSearchIngredients($search);
            if (count($search) < 2) {
                Yii::$app->session->setFlash('warning', 'Выберите больше ингредиентов');
                return $this->redirect('/');
            } else {
                $result = $this->checkingExactIngFoods($searchResults, $search);

                if (!empty($result)) {
                    return $this->render('index', [
                        'data' => $data,
                        'results' => $result,
                    ]);
                } else {
                    arsort($searchResults);
                    $newSearchResults = [];
                    foreach ($searchResults as $key => $value) {
                        if (count($value) >= 2) {
                            $newSearchResults[] = $key;
                        }
                    }
                    if (!empty($newSearchResults)) {
                        return $this->render('index', [
                            'data' => $data,
                            'results' => $newSearchResults,
                        ]);
                    } else {
                        Yii::$app->session->setFlash('warning', "Ничего не найдено");
                    }
                }
            }
        }
        return $this->render('index', [
            'data' => $data,
        ]);
    }

    public function arrayMultiToOne($arr)
    {
        if (!is_array($arr)) {
            return FALSE;
        }

        $arrResult = array();
        foreach ($arr as $key => $value) {
            if (!is_array($value)) {
                return FALSE;
            }
            $arrResult[$value['id']] = $value['title'];
        }

        return $arrResult;
    }

    public function getSearchIngredients($arr)
    {
        $allIngs =  FoodIngredient::find()->where(['ing_id' => $arr])->asArray()->all();
        $newArr = [];

        foreach ($allIngs as $key => $value) {
            $newArr[$value['food_id']] = empty($newArr[$value['food_id']]) ?
                [$value['ing_id']] :
                array_merge($newArr[$value['food_id']], [$value['ing_id']]);
        }
        return $newArr;
    }

    public function checkingExactIngFoods($searchResults, $search)
    {
        $result = [];
        foreach ($searchResults as $key => $value) {
            if (count(array_intersect($value, $search)) == count($search)) {
                $result[] = $key;
            }
        }
        return $result;
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
