<?php

namespace backend\modules\location;

use Yii;
/**
 * location module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'backend\modules\location\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        Yii::$app->formatter->locale = 'th_TH';
        Yii::$app->formatter->calendar = \IntlDateFormatter::TRADITIONAL;
        if (!isset(\Yii::$app->i18n->translations['tc'])) {
            \Yii::$app->i18n->translations['tc'] = [
                'class' => 'yii\i18n\PhpMessageSource',
                'sourceLanguage' => 'en',
                'basePath' => '@backend/modules/location/messages',
            ];
        }
		parent::init();

		$this->layout = 'location';
		$this->params['ModuleVers'] = '1.1';
		$this->params['title'] = 'ข้อมูลสถานที่ในองค์กร';
        $this->params['modulecookies'] = 'locationck';
        // custom initialization code goes here
    }
}
