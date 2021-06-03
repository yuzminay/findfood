<?php

use app\models\Food;
use yii\widgets\ActiveForm;

use kartik\select2\Select2;

?>


<div class="container">
    <div class="search__bar">
        <form action="/" style="width:100%">
            <?= Select2::widget([
                'name' => 'search',
                'data' => $data,
                'options' => ['multiple' => true, 'onkeypress' => "handle"]
            ]);
            ?>
            <button type="submit">FIND</button>
        </form>
    </div>
    <?php echo Yii::$app->session->getFlash('warning'); ?>
</div>
<div class="food__results">
    <div class="container">
        <div class="foods__inner">
            <?php if (@$results) : ?>
                <?php foreach ($results as $food_id) : ?>
                    <?php
                    $food = Food::findOne(['id' => $food_id])
                    ?>
                    <div class="food__cart">
                        <img src="<?= $food->getImageUrl() ?>" alt="" class="food__img">
                        <div class="food__name"><?= $food->title ?></div>
                        <div class="tags">

                            <?php
                            $ing_arr = $food->getIngredients()->select('title')->asArray()->all();
                            foreach ($ing_arr as $key => $value) :
                            ?>
                                <a href="#" class="tag"><?= $value['title'] ?></a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>