<?php

use yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\inventory\models\MainLocationSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="main-location-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'loc_name') ?>

    <?= $form->field($model, 'loc_name_eng') ?>

    <?= $form->field($model, 'loc_floor') ?>

    <div class="form-group">
        <?= Html::submitButton(Html::icon('search').' '.Yii::t('inventory/app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Html::icon('refresh').' '.Yii::t('inventory/app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
