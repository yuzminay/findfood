<?php

use yii\widgets\ActiveForm;

use kartik\select2\Select2;

$data = ['bal', 'alma', 'duz'];
?>
<?php $form = ActiveForm::begin(); ?>

<?php

// Multiple select without model
echo Select2::widget([
    'name' => 'search',
    'value' => '',
    'data' => $data,
    'options' => ['multiple' => true, 'placeholder' => 'Select states ...']
]);

?>

<?php ActiveForm::end(); ?>

<div class="search__bar">
    <form action="">
        <input class="search__bar-input" type="text" value="" data-role="tagsinput" />
        <button type="submit"><img src="/web/img/search.svg" alt="search"></button>
    </form>
</div>
<div class="food__results">
    <div class="container">
        <div class="foods__inner">
            <div class="food__cart">
                <img src="/web/img/food1.png" alt="" class="food__img">
                <div class="food__name">Pizza</div>
                <div class="tags">
                    <a href="#" class="tag">floor</a>
                </div>
            </div>
            <div class="food__cart">
                <img src="/web/img/food2.png" alt="" class="food__img">
                <div class="food__name">Pizza</div>
                <div class="tags">
                    <a href="#" class="tag">floor</a>
                    <a href="#" class="tag">floor</a> <a href="#" class="tag">floor</a> <a href="#" class="tag">floor</a>
                </div>
            </div>
        </div>
    </div>
</div>