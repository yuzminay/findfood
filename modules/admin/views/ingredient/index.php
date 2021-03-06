<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ingredients';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ingredient-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Ingredient', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'title',
            [
                'attribute' => 'active',
                'content' => function ($model) {
                    return Html::tag('span', $model->active ? 'Active' : 'Non Active', [
                        'class' => $model->active ? 'btn btn-success' : 'btn btn-danger'
                    ]);
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>