<?php

namespace adzpire\location\controllers;

use Yii;
use adzpire\location\models\MainLocation;
use adzpire\location\models\MainLocationSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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
        ];
    }

    /**
     * Lists all MainLocation models.
     * @return mixed
     */
    public function actionIndex()
    {

        Yii::$app->view->title = Yii::t('inventory/app', 'Main Locations').' - '.Yii::t('inventory/app', Yii::$app->controller->module->params['title']);

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

        Yii::$app->view->title = Yii::t('inventory/app', 'Detail').' : '.$model->id.' - '.Yii::t('inventory/app', Yii::$app->controller->module->params['title']);

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
        Yii::$app->view->title = Yii::t('inventory/app', 'Create').' - '.Yii::t('inventory/app', Yii::$app->controller->module->params['title']);

        $model = new MainLocation();

        /* if enable ajax validate
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }*/

        if ($model->load(Yii::$app->request->post())) {
            if($model->save()){
                Yii::$app->getSession()->setFlash('addflsh', [
                    'type' => 'success',
                    'duration' => 4000,
                    'icon' => 'glyphicon glyphicon-ok-circle',
                    'message' => Yii::t('inventory/app', 'UrDataCreated'),
                ]);
                return $this->redirect(['view', 'id' => $model->wu_id]);
            }else{
                Yii::$app->getSession()->setFlash('addflsh', [
                    'type' => 'danger',
                    'duration' => 4000,
                    'icon' => 'glyphicon glyphicon-remove-circle',
                    'message' => Yii::t('inventory/app', 'UrDataNotCreated'),
                ]);
            }
            return $this->redirect(['view', 'id' => $model->id]);
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

        Yii::$app->view->title = Yii::t('inventory/app', 'Update {modelClass}: ', [
                'modelClass' => 'Main Location',
            ]) . $model->id.' - '.Yii::t('inventory/app', Yii::$app->controller->module->params['title']);



        if ($model->load(Yii::$app->request->post())) {
            if($model->save()){
                Yii::$app->getSession()->setFlash('edtflsh', [
                    'type' => 'success',
                    'duration' => 4000,
                    'icon' => 'glyphicon glyphicon-ok-circle',
                    'message' => Yii::t('inventory/app', 'UrDataUpdated'),
                ]);
                return $this->redirect(['view', 'id' => $model->wu_id]);
            }else{
                Yii::$app->getSession()->setFlash('edtflsh', [
                    'type' => 'danger',
                    'duration' => 4000,
                    'icon' => 'glyphicon glyphicon-remove-circle',
                    'message' => Yii::t('inventory/app', 'UrDataNotUpdated'),
                ]);
            }
            return $this->redirect(['view', 'id' => $model->id]);
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

        Yii::$app->getSession()->setFlash('edtflsh', [
            'type' => 'success',
            'duration' => 4000,
            'icon' => 'glyphicon glyphicon-ok-circle',
            'message' => Yii::t('inventory/app', 'UrDataDeleted'),
        ]);


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
