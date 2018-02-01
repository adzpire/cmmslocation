<?php

use yii\bootstrap\Html;
//use yii\grid\GridView;

use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\inventory\models\MainLocationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="main-location-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php Pjax::begin(); ?>    <?= GridView::widget([
        //'id' => 'kv-grid-demo',
        'dataProvider'=> $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'id',
                'headerOptions' => [
                    'width' => '50px',
                ],
            ],
            'loc_name',
            'loc_name_eng',
            'loc_floor',
        ],
        'pager' => [
            'firstPageLabel' => Yii::t('app', 'รายการแรกสุด'),
            'lastPageLabel' => Yii::t('app', 'รายการท้ายสุด'),
        ],
        'responsive'=>true,
        'hover'=>true,
        'toolbar'=> [
            ['content'=>
                //Html::a(Html::icon('plus'), ['create'], ['class'=>'btn btn-success', 'title'=>Yii::t('app', 'Add Book')]).' '.
                Html::a(Html::icon('repeat'), ['grid-demo'], ['data-pjax'=>0, 'class'=>'btn btn-default', 'title'=>Yii::t('app', 'Reset Grid')])
            ],
            //'{export}',
            '{toggleData}',
        ],
        'panel'=>[
            'type'=>GridView::TYPE_INFO,
            'heading'=> Html::icon('map-marker').' '.Html::encode($this->title),
        ],
    ]); ?>
    <?php /* adzpire grid tips
		[
		'attribute' => 'we_date',
		'value' => 'we_date',
			'filter' => \yii\jui\DatePicker::widget([
				'model'=>$searchModel,
				'attribute'=>'we_date',
				//'language' => 'ru',
				'dateFormat' => 'yyyy-M-dd',
				'options' => [
					'class' => 'form-control',
					'placeholder' => 'choose date...'
				]
			]),
			//'format' => 'html',
			'format' => ['date']

		],
		[
			'attribute' => 'we_creator',
			'value' => 'weCr.userPro.nameconcatened'
		],
	 */
    ?>
    <?php Pjax::end(); ?>
</div>