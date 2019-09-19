<?php

namespace frontend\controllers;

use frontend\models\Page;
use frontend\models\PageTreeForm;
use frontend\models\TipSvyazi;
use frontend\models\Url;
use Yii;
use frontend\models\PageTree;
use frontend\models\PageTreeSearch;
use yii\base\DynamicModel;
use yii\db\Query;
use yii\helpers\FileHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\JsExpression;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * PageTreeController implements the CRUD actions for PageTree model.
 */
class PageTreeController extends Controller
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

//    /**
//     * Выводит все модели Page.
//     * @return mixed
//     */
//    public function actionIndex()
//    {
//        $searchModel = new PageTreeSearch();
//        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
//
//        $modelPage = Page::find()->orderBy('title ASC')->all();
//
//        foreach ($modelPage as $item) {
//            $arrPage[$item->id] = $item->title;
//        }
//
//        return $this->render('index', [
//            'searchModel' => $searchModel,
//            'dataProvider' => $dataProvider,
//            'arrPage' => $arrPage,
//        ]);
//    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Displays a single PageTree model.
     * @param string $id
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
     * Рендерит представление для загрузки файлов
     */
    public function actionFileInputExample()
    {
        return $this->render('file-input-example');
    }

//    /**
//     * Creates a new PageTree model.
//     * If creation is successful, the browser will be redirected to the 'view' page.
//     * @return mixed
//     */
//    public function actionCreate()
//    {
//        $model = new PageTree();
//
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['index', 'id' => $model->id]);
//        }
//
//        return $this->render('create', [
//            'model' => $model,
//        ]);
//    }

    /**
     * Updates an existing PageTree model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);

    }

    public function actionNewUpdate($id)
    {
        $model = $this->findModel($id);

            $newmodel = new PageTreeForm();

//        print_r('<pre>');
//        print_r($newmodel);
//        print_r('</pre>');

        if ($newmodel->load(Yii::$app->request->post())) {

            if ($newmodel->validate()) {
                $model->name = $newmodel->name;
                $model->tip_svyazi_id = $newmodel->tip_svyazi_id;
                $model->url = $newmodel->url;
                $model->link_id = $newmodel->page;
                $model->target = $newmodel->target;
                if ($model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
            //todo $model->errors
        }

        $newmodel->name = $model->name;
        $newmodel->tip_svyazi_id = $model->tip_svyazi_id;
        $newmodel->url = $model->url;
        $newmodel->page = $model->link_id;
        $newmodel->target = $model->target;

        return $this->render('newupdate', [
            'newmodel' => $newmodel,
        ]);
    }

    /**
     * Deletes an existing PageTree model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PageTree model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return PageTree the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PageTree::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     *
     * @return array
     */
    public function actionLink()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $cat_id = $parents[0];
                if (!empty($_POST['depdrop_params'])) {
                    $params = $_POST['depdrop_params'];
                }

                if ($cat_id == 1) {
                    //todo добавляем текстовое поле для ввода url, поле target устанавливаем на 1

                }

                if ($cat_id == 1) {
                    //todo добавляем поле select для выбора из таблицы page и
                    // поле select для выбора как открыть выбранную странцу (в номом (1) или том же (0) окне)
                }

                $out = PageTree::getLinkList($cat_id);
                // the getSubCatList1 function will query the database based on the
                // cat_id, param1, param2 and return an array like below:
                // [
                //    'group1' => [
                //        ['id' => '<sub-cat-id-1>', 'name' => '<sub-cat-name1>'],
                //        ['id' => '<sub-cat_id_2>', 'name' => '<sub-cat-name2>']
                //    ],
                //    'group2' => [
                //        ['id' => '<sub-cat-id-3>', 'name' => '<sub-cat-name3>'],
                //        ['id' => '<sub-cat-id-4>', 'name' => '<sub-cat-name4>']
                //    ]
                // ]

                $selected = PageTree::getDefaultLinkList();
                // the getDefaultSubCat function will query the database
                // and return the default sub cat for the cat_id

                return ['output' => $out, 'selected' => $selected];
            }
        }
        return ['output' => '', 'selected' => ''];
    }

    public function actionShowForm()
    {
        if (Yii::$app->request->isAjax) {
            $cat_id = $_POST['type'];
            if ($cat_id == 1) {
                return $this->renderAjax('_form_url', [
                    'model' => new Url,
                ]);
//$script = <<< JS
//$(document).ready(function(){
//    $('#pagetree-tip-svyazi-id').change(function(){
//        if ($('#pagetree-tip-svyazi-id option:selected')) {
//            let p = document.getElementById("result");
//            let new_label = document.createElement('label');
//            new_label.setAttribute('class', 'control-label');
//            new_label.setAttribute('for', 'input-url');
//            new_label.innerText = 'Введите URL';
//            let input_url = document.createElement('input');
//            input_url.setAttribute('type', 'text');
//            input_url.setAttribute('id', 'pagetree-input-url');
//            input_url.setAttribute('class', 'form-control');
//            input_url.setAttribute('name', 'PageTree[input-url]');
//            input_url.setAttribute('area-required', 'true');
//            let help_block = document.createElement('div');
//            help_block.setAttribute('class', 'help-block');
//            p.appendChild(new_label);
//            p.appendChild(input_url);
//            p.appendChild(help_block);
//        } else if ($("#pagetree-tip-svyazi-id option:selected").hasClass("sel2")) {
//            $("#result").html("<input type='text' name='type' value='Ищу водителя / исполнителя'>");
//        } else if ($('#pagetree-tip-svyazi-id option:selected').hasClass("sel3")) {
//            $("#result").html("<input type='text' name='type' value='Ищу водителя / исполнителя'>");
//        } else if ($('#pagetree-tip-svyazi-id option:selected').hasClass("sel4")) {
//            $("#result").html("<input type='text' name='type' value='Отдам заказ / Ищу исполнителя'>");
//        }
//    });
//});
//JS;
//$this->registerJs($script);

            }
        }
        return $this->render(error('Не аякс'));
    }

    public function actionCityList($q = null, $id = null) {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($q)) {
            $query = new Query;
            $query->select('id, title AS text')
                ->from('k_tip_svyazi')
                ->where(['like', 'name', $q])
                ->limit(10);
            $command = $query->createCommand();
            $data = $command->queryAll();
            $out['results'] = array_values($data);
        }
        elseif ($id > 0) {
            $out['results'] = ['id' => $id, 'text' => TipSvyazi::find($id)->title];
        }
        return $out;
    }

    public function actionAddFields($tip_svyazi_id)
    {
        if ($tip_svyazi_id == 1) {
            //$tip_svyazi_id = Page::find()->all();
            echo Json::encode($tip_svyazi_id);
        }
        //найти нужную страницу
        if ($tip_svyazi_id == 2) {
            $tip_svyazi_id = Page::find()->all();
            echo Json::encode($tip_svyazi_id);
        }
    }

    public function actionSay($message = 'Привет')
    {
        return $this->render('say', ['message' => $message]);
    }
}
