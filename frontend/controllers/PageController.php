<?php

namespace frontend\controllers;

use frontend\models\FileStorage;
use Yii;
use frontend\models\Page;
use frontend\models\PageSearch;
use frontend\models\PageTree;
use yii\base\DynamicModel;
use yii\db\Query;
use yii\helpers\FileHelper;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\web\UploadedFile;
/**
 * PageController implements the CRUD actions for Page model.
 */
class PageController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Page models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new Page();
        $model->site_lang_id = 1;
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            $model = new Page();
//        }

        $searchModel = new PageSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if (isset($_POST['hasEditable'])) {

            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            // read your posted model attributes
            $pageId = Yii::$app->request->post('editableKey');
            $editableIndex = Yii::$app->request->post('editableIndex');
            $model = Page::findOne($pageId);

            //print_r($_POST[$editableIndex]); //die();
            $_POST['Page'] = $_POST['Page'][$editableIndex];
            if ($model->load($_POST)) {
                // read or convert your posted information
                $value = $model->created_by;
                $model->id = $pageId;
                $model->site_lang_id = 1;
                $model->save();

                // return JSON encoded output in the below format
                return ['output'=>$value, 'message'=>$model->getErrors()];

                // alternatively you can return a validation error
                // return ['output'=>'', 'message'=>'Validation error'];
            }
            // else if nothing to do always return an empty JSON encoded output
            else {
                return ['output'=>'', 'message'=>''];
            }
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }

    /**
     * Displays a single Page model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Page model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Page();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Page model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->ip_address = inet_pton(Yii::$app->request->userIP);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Page model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Рендерит представление для тестов динамически создаваемых дивов и использования php через ajax-запрос
     * @return string
     */
    public function actionTestPageForm()
    {
        return $this->render('test-page-form');
    }

    /**
     * Рендерит представление для тестов динамически создаваемых дивов и использования php через ajax-запрос
     * @return string
     */
    public function actionTestPageSelect2()
    {
        return $this->render('test-page-select2');
    }

    /**
     * Finds the Page model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Page the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Page::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
//
//    public function actionLists($id)
//    {
//        $countPages = Page::find()
//        ->where(['id' => $id])
//        ->count();
//        $pages = Page::find()
//        ->where(['id' => $id])
//        ->orderBy('title')
//        ->all();
//        if ($countPages > 0) {
//            echo "<option>выбрать ...</option>";
//            foreach ($pages as $page){
//                echo "<options value='".$page->id."'>".$page->title."</options>";
//            }
//        } else {
//            echo "<option> - </option>";
//        }
//    }
    /**********************************************************************************
     * @param null $q
     * @param null $id
     * @return array
     * @throws \yii\db\Exception
     */

// Для работы Select2
/*
    public function actionPageTitle($q = null, $id = null) {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'title' => '']];
        if (!is_null($q)) {
            $query = new Query();
            $query->select('id, title AS text')
                ->from('page')
                ->where(['like', 'title', $q])
                ->limit(10);
            $command = $query->createCommand();
            $data = $command->queryAll();
            $out['results'] = array_values($data);
        }
        elseif ($id > 0) {
            $out['results'] = ['id' => $id, 'title' => Page::find($id)->title];
        }
        return $out;
    }
*/

/*****************************************************************************************
 *
 */

//Для виджета DepDrop

    public static function getPageList()
    {
        $pages = Page::find()
            ->select(['id', 'title as name'])
            ->orderBy('name')
            ->asArray()
            ->all();

        return $pages;
    }

/*
    public function getPageList($page_id)
    {
        $pageList = Page::find()
            ->count('id, title')
            ->where(['id' => $page_id])
            ->orderBy('name')
            ->all();

        return $pageList;
    }
*/

    public function actionList()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $page_id = $parents[0];
                $out = self::getPageList($page_id);
                // the getPageList function will query the database based on the
                // cat_id and return an array like below:
                // [
                //    ['id'=>'<sub-cat-id-1>', 'name'=>'<sub-cat-name1>'],
                //    ['id'=>'<sub-cat_id_2>', 'name'=>'<sub-cat-name2>']
                // ]
                return ['output'=>$out, 'selected'=>''];
            }
        }
        return ['output'=>'', 'selected'=>''];
    }

    public function actionSay($message = 'Привет')
    {
        return $this->render('say', ['message' => $message]);
    }

}
