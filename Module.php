<?php

namespace adzpire\location;

use Yii;
/**
 * location module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'adzpire\location\controllers';

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
                'basePath' => '@vendor/messages',
            ];
        }
		parent::init();

		$this->layout = 'location';
		$this->params['ModuleVers'] = '1.0.0';
		$this->params['title'] = 'location';
        // custom initialization code goes here
    }
}
