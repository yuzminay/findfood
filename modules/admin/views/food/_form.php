<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Food */
/* @var $form yii\widgets\ActiveForm */

$foodsArray = \yii\helpers\ArrayHelper::map($modelIngs, 'id', 'title');
?>

<div class="food-form">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>


    <?= Html::img($model->getImageUrl(), ['style' => 'width:150px']) ?>

    <div class="row justify-content-center pt-4">
        <div class="col-md-4">
            <?= $form->field($model, 'imageFile', [
                'template' => '
          <div class="custom-file">
            {input}
            {label}
            {error}
          </div>
                ',
                'labelOptions' => ['class' => 'custom-file-label'],
                'inputOptions' => ['class' => 'custom-file-input'],
            ])->textInput(['type' => 'file']) ?>
        </div>
    </div>
    <?= $form->field($model, 'ingrsArray')->checkboxList($foodsArray) ?>

    <?= $form->field($model, 'active')->dropDownList([
        '1' => 'Active',
        '0' => 'Not Active'
    ]) ?>



    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>