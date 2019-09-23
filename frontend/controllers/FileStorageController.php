<?php

namespace frontend\controllers;

use app\models\FileStorageSearch;
use Yii;
use yii\filters\VerbFilter;
use yii\image\drivers\Image;
use yii\web\Controller;
use yii\helpers\FileHelper;
use yii\web\MethodNotAllowedHttpException;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use frontend\models\FileStorage;
use yii\web\Response;


/**
 * Метод для сохранения файлов
 */

class FileStorageController extends Controller
{

    public function actionIndex()
    {
        $searchModel = new FileStorageSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('/picture/gridView', [
        //return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Page model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new FileStorage();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->id]);
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                    'delete-image' => ['POST'],
                    'sort-image' => ['POST'],
                ],
            ],
        ];
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
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

    public function actionDeleteImage()
    {
        if (($model = FileStorage::findOne(Yii::$app->request->post('key'))) and $model->delete()) {
            return true;
        } else {
            throw new NotFoundHttpException('Искомая страница не найдена!');
        }
    }

    public function actionSortImage($id)
    {
        if(Yii::$app->request->isAjax){
            $post = Yii::$app->request->post('sort');
            if($post['oldIndex'] > $post['newIndex']){
                $param = ['and',['>=','sort',$post['newIndex']],['<','sort',$post['oldIndex']]];
                $counter = 1;
            }else{
                $param = ['and',['<=','sort',$post['newIndex']],['>','sort',$post['oldIndex']]];
                $counter = -1;
            }
            FileStorage::updateAllCounters(['sort' => $counter], [
                'and',['is_image' => 1,'id'=>$id],$param
            ]);
            FileStorage::updateAll(['sort' => $post['newIndex']], [
                'id' => $post['stack'][$post['newIndex']]['key']
            ]);
            return true;
        }
        throw new MethodNotAllowedHttpException();
    }

    public function actionForm()
    {
        return $this->render('_form');
    }

    /**
     * Finds the Page model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FileStorage the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FileStorage::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * @return array
     * @throws \yii\base\Exception
     * @throws \yii\web\BadRequestHttpException
     */
    public function actionSaveImage()
    {
        $this->enableCsrfValidation = false;
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $dir = Yii::getAlias('@images') . '/';
            if (!file_exists($dir)) {
                FileHelper::createDirectory($dir);
            }
//            $result_link = 'http://yii2.udemy.course/index.php/en12321312312312';
//            $result_link = str_replace('http://yii2.udemy.course/index.php/en',
//                    \yii\helpers\Url::home(true)).'uploads/images/'.$post['ftype'].'/';
            //$file = $_FILES['attachment']['name'][0];
            //$file = UploadedFile::getInstanceByName('FileStorage[attachment]');
            $model = new FileStorage();
            $model->file_url = UploadedFile::getInstance($model, 'attachment');
            var_dump($model->file_url); die();
            $model->file_url = strtotime('now') . '_' . Yii::$app->getSecurity()->generateRandomString(6) . '.' . $file->extension;
            $model->load($post);
            $model->validate();


            if ($model->hasErrors()) {
                $result = [
                    'error' => $model->getFirstError('attachment')
                ];
            } else {
                if ($model->attachment->saveAs($dir . $model->file_url)) {
                    $imag = Yii::$app->image->load($dir . $model->file_url);
                    $imag->resize(800, NULL, Image::PRECISE)->save($dir . $model->file_url, 85);
                    $result = [
                        'filelink' => 'http://yii2.udemy.course/index.php/en/' . $dir . $model->file_url,
                        'filename' => $model->file_url,
                    ];
                } else {
                    $result = [
//                        'error' => Yii::t('vova07/imperavi', 'ERROR_CAN_NOT_UPLOAD'),
                        'error' => 'Ошибка 001. Файл не загрузился',
                    ];
                }
                $model->save();
            }
            Yii::$app->response->format = Response::FORMAT_JSON;

            return $result;
        } else {
            throw new \yii\web\BadRequestHttpException('Only POST is allowed');
        }
    }

    /**
     * Загрузить несколько изображений на сервер (метод Андрея)
     */
    public function actionUploadMultiImage() {
        $model = new UploadedFile();

        //if ($model->load(Yii::$app->request->post()) && $model->validate()) {
        if (Yii::$app->request->isPost) {
            // Получить файл, который пользователь пытается загрузить на саервер
            $model->fileUpload = UploadedFile::getInstance($model, 'fileUpload');
            // Сохранить файл
            if ($model->uploadImage()) {
                Yii::$app->session->setFlash('flashMessage', 'Файл был успешно сохранен.');
            }
            else {
                Yii::$app->session->setFlash('flashMessage', 'При загрузке файла произошла ошибка.');
            }
            return $this->refresh();
        }

        return $this->render('uploadImage', [
            'model' => $model
        ]);
    }

    /**
     * Сохранение картинки из картиковского FileInput
     * @throws \yii\base\Exception
     */
    public function actionSaveImg2()
    {
        $model = new FileStorage();
        //if ($attachment = UploadedFile::getInstance($model, 'attachment')) {
        if ($attachment = UploadedFile::getInstanceByName('FileStorage[attachment]')) {
            $dir = Yii::getAlias('@images');
            if (file_exists($dir . '/' . $model->file_url)) {
                unlink($dir . '/' . $model->file_url);
            }
            $model->file_url = strtotime('now') . '_' . Yii::$app->getSecurity()->generateRandomString(6) . '.' . $attachment->extension;
            $attachment->saveAs($dir . '/' . $model->file_url);

            Yii::$app->response->format = Response::FORMAT_JSON;
//
            return $attachment;
        }
        else {
            return 'error: "Файла для загрузки не существует"';
        }
    }

    /**
     * Пример загрузки на стороне сервера на базе Картика: http://plugins.krajee.com/file-input
     */
    function actionUpload()
    {
        if (Yii::$app->request->isPost) {
            $this->enableCsrfValidation = false;
            $preview = $config = $errors = [];
            $targetDir = Yii::getAlias('@images');

            if (!file_exists($targetDir)) {
                FileHelper::createDirectory($targetDir);
            }

            $fileBlob = 'FileStorage';                      // the parameter name that stores the file blob
            if (isset($_FILES[$fileBlob])) {

//        if (isset($_FILES[$fileBlob]) && isset($_POST['uploadToken'])) {
//            $token = $_POST['uploadToken'];          // gets the upload token
//            if (!validateToken($token)) {            // your access validation routine (not included)
//                return [
//                    'error' => 'Access not allowed'  // return access control error
//                ];
//            }
                $initFileName = $_FILES[$fileBlob]['name']['attachment'][0];          // you receive the file name as a separate post data
                $ftype = explode('.', $initFileName);
                $ftype = end($ftype);
                $fileName =  strtotime('now') . '_' . Yii::$app->getSecurity()->generateRandomString(6) . '.' . $ftype;
                $file = $_FILES[$fileBlob]['tmp_name']['attachment'][0];  // the path for the uploaded file chunk
                $fileSize = $_FILES[$fileBlob]['size']['attachment'][0];          // you receive the file size as a separate post data
                $fileId = $_POST['fileId'];              // you receive the file identifier as a separate post data
//            $index =  $_POST['chunkIndex'];          // the current file chunk index
//            $totalChunks = $_POST['chunkCount'];     // the total number of chunks for this file
                $targetFile = $targetDir . '/' . $fileName;  // your target file path
//            if ($totalChunks > 1) {                  // create chunk files only if chunks are greater than 1
//                $targetFile .= '_' . str_pad($index, 4, '0', STR_PAD_LEFT);
//            }
                //$thumbnail = $targetDir . '/50x50/' . $fileName;
                //print_r($thumbnail); die();
                if (move_uploaded_file($file, $targetFile)) {
//                // get list of all chunks uploaded so far to server
//                $chunks = glob("{$targetDir}/{$fileName}_*");
//                // check uploaded chunks so far (do not combine files if only one chunk received)
//                $allChunksUploaded = $totalChunks > 1 && count($chunks) == $totalChunks;
//                if ($allChunksUploaded) {           // all chunks were uploaded
//                    $outFile = $targetDir.'/'.$fileName;
//                    // combines all file chunks to one file
//                    combineChunks($chunks, $outFile);
//                }
                    // if you wish to generate a thumbnail image for the file
                    //$targetUrl = getThumbnailUrl($path, $fileName);
//                $targetUrl = $targetDir . '/50x50/' . $fileName;
                    $targetUrl = $targetDir . '/' . $fileName;
                    $model = new FileStorage();
                    $model->file_url = $targetUrl;
                    $model->load(Yii::$app->request->post());
                    $model->validate();
                    $model->save();

                    //print_r($targetUrl); die();
                    // separate link for the full blown image file
                    $zoomUrl = $targetDir . '/' . $fileName;
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return [
                        //'chunkIndex' => $index,         // the chunk index processed
                        'initialPreview' => $targetUrl, // the thumbnail preview data (e.g. image)
                        'initialPreviewConfig' => [
                            [
                                'type' => 'image',      // check previewTypes (set it to 'other' if you want no content preview)
                                'caption' => $fileName, // caption
                                'key' => $fileId,       // keys for deleting/reorganizing preview
                                'fileId' => $fileId,    // file identifier
                                'size' => $fileSize,    // file size
                                'zoomData' => $zoomUrl, // separate larger zoom data
                            ]
                        ],
                        'append' => true
                    ];
                } else {
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return ['error' => 'Error uploading chunk ' . $_POST['chunkIndex']];
                }
            } else {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ['error' => 'Файл не найден!!!'];
            }
        } else {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['error' => 'Метод не ПОСТ!'];
        }
    }

    // generate and fetch thumbnail for the file
    function getThumbnailUrl($path, $fileName)
    {
        // assuming this is an image file or video file
        // generate a compressed smaller version of the file
        // here and return the status
        $sourceFile = Yii::getAlias('@images') . '/' . $fileName;
        $targetFile = Yii::getAlias('@images') . '/50x50/' . $fileName;
        //
        // generateThumbnail: method to generate thumbnail (not included)
        // using $sourceFile and $targetFile
        //
        //if (generateThumbnail($sourceFile, $targetFile) === true) {
        if ($targetFile) {
//            $imag = Yii::$app->image->load($dir . '/' . $this->file_url);
//            $imag->background('#fff', 0);
//            $imag->resize('50', '50', Image::INVERSE);
//            $imag->crop('50', '50');
            return Yii::getAlias('@images') . '/50x50/' . $fileName;
        } else {
            return Yii::getAlias('@images') . '/' . $fileName; // return the original file
        }
    }
}