<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Food */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Foods', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="food-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
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
                'format' => 'html',
                'value' => function ($model) {
                    return Html::tag('span', $model->active ? 'Active' : 'Not Active', [
                        'class' => $model->active ? 'btn btn-success' : 'btn btn-danger'
                    ]);
                }
            ],
        ],
    ]) ?>

</div>