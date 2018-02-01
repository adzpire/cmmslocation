<?php

namespace backend\modules\location\controllers;

use Yii;
use backend\modules\location\models\MainLocationSearch;
use yii\web\Controller;
use yii\helpers\Url;
/**
 * Default controller for the `location` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public $moduletitle;
    public function beforeAction($action){
        $this->moduletitle = Yii::t('app', Yii::$app->controller->module->params['title']);
        return parent::beforeAction($action);
    }

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
    public function actionReadme()
    {
        return $this->render('readme');
    }
    public function actionChangelog()
    {
        return $this->render('changelog');
    }
    public function actionSetvercookies()
    {
        $cookie = \Yii::$app->response->cookies;
        $cookie->add(new \yii\web\Cookie([
            'name' => Yii::$app->controller->module->params['modulecookies'],
            'value' => Yii::$app->controller->module->params['ModuleVers'],
            'expire' => time() + (60*60*24*30),
        ]));
        $this->redirect(Url::previous());
    }
}
