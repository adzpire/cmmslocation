<?php

use yii\bootstrap\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\inventory\models\MainLocation */

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'รายการ'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="main-location-view">

<div class="panel panel-success">
	<div class="panel-heading">
		<span class="panel-title"><?= Html::icon('eye').' '.Html::encode($this->title) ?></span>
		<?= Html::a( Html::icon('fire').' '.Yii::t('app', 'ลบ'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger panbtn',
            'data' => [
                'confirm' => Yii::t('app', 'คุณมั่นใจว่าต้องการลบข้อมูลนี้?'),
                'method' => 'post',
            ],
        ]) ?>
		<?= Html::a( Html::icon('pencil').' '.Yii::t('app', 'อัพเดต'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary panbtn']) ?>
	</div>
	<div class="panel-body">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
 			[
				'label' => $model->attributeLabels()['id'],
				'value' => $model->id,			
				//'format' => ['date', 'long']
			],
     			[
				'label' => $model->attributeLabels()['loc_name'],
				'value' => $model->loc_name,			
				//'format' => ['date', 'long']
			],
     			[
				'label' => $model->attributeLabels()['loc_name_eng'],
				'value' => $model->loc_name_eng,			
				//'format' => ['date', 'long']
			],
     			[
				'label' => $model->attributeLabels()['loc_floor'],
				'value' => $model->loc_floor,			
				//'format' => ['date', 'long']
			],
    	],
    ]) ?>
	</div>
</div>
</div>