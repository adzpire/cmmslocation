<?php

namespace backend\modules\location\controllers;

use Yii;
use backend\modules\location\models\MainLocation;
use backend\modules\location\models\MainLocationSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Response;
use yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;

/**
 * LocController implements the CRUD actions for MainLocation model.
 */
class LocController extends Controller
{
    /**
     * @inheritdoc
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
            'access' => [
                'class' => AccessControl::className(),
                //'only' => ['create', 'update', 'delete'],
                'rules' => [
                    // allow authenticated users
                    [
                        'allow' => true,
                        'roles' => ['root'],
                    ],
                    // everything else is denied by default
                ],
            ],
        ];
    }

    public $moduletitle;
    public function beforeAction($action){
        $this->moduletitle = Yii::t('app', Yii::$app->controller->module->params['title']);
        return parent::beforeAction($action);
    }

    /**
     * Lists all MainLocation models.
     * @return mixed
     */
    public function actionIndex()
    {

        Yii::$app->view->title = Yii::t('app', 'หน้ารายการ').' - '.$this->moduletitle;

        $searchModel = new MainLocationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MainLocation model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        Yii::$app->view->title = Yii::t('app', 'ดูรายละเอียด').' : '.$model->id.' - '.$this->moduletitle;

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new MainLocation model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        Yii::$app->view->title = Yii::t('app', 'สร้างใหม่').' - '.$this->moduletitle;

        $model = new MainLocation();

        /* if enable ajax validate
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }*/

        if ($model->load(Yii::$app->request->post())) {
            if($model->save()){
                $this->succalert('edtflsh', 'สร้างเรียบร้อย');
                return $this->redirect(['view', 'id' => $model->id]);
            }else{
                $this->dangalert('edtflsh', 'สร้างรายการไม่ได้');
            }
            print_r($model->getErrors());exit;
        }

        return $this->render('create', [
            'model' => $model,
        ]);


    }

    /**
     * Updates an existing MainLocation model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        Yii::$app->view->title = Yii::t('app', 'อัพเดต {modelClass}: ', [
                'modelClass' => 'Main Location',
            ]) . $model->id.' - '.$this->moduletitle;



        if ($model->load(Yii::$app->request->post())) {
            if($model->save()){
                $this->succalert('edtflsh', 'แก้ไขเรียบร้อย');
                return $this->redirect(['view', 'id' => $model->id]);
            }else{
                $this->dangalert('edtflsh', 'แก้ไขรายการไม่ได้');
            }
            print_r($model->getErrors());exit;
        }

        return $this->render('update', [
            'model' => $model,
        ]);


    }

    /**
     * Deletes an existing MainLocation model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        $this->succalert('edtflsh', 'ลบเรียบร้อย');


        return $this->redirect(['index']);
    }

    /**
     * Finds the MainLocation model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MainLocation the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MainLocation::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
