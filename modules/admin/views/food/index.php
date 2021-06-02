<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Foods';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="food-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Food', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'title',
            [
                'attribute' => 'img',
                'format' => ['html'],
                'value' => function ($model) {
                    return Html::img($model->getImageUrl(), ['style' => 'width: 150px']);
                }
            ],
            [
                'attribute' => 'active',
                'content' => function ($model) {
                    return Html::tag('span', $model->active ? 'Active' : 'Not Active', [
                        'class' => $model->active ? 'btn btn-success' : 'btn btn-danger'
                    ]);
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>