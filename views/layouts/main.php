<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
  <meta charset="<?= Yii::$app->charset ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php $this->registerCsrfMetaTags() ?>
  <title>FindFood | <?= Html::encode($this->title) ?></title>
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <?php $this->head() ?>
</head>

<body>
  <?php $this->beginBody() ?>

  <header class="header">
    <div class="container">
      <div class="header__inner">
        <a href="#" class="home__link">Foods</a>
        <a href="#" class="logo">
          <img src="web/img/findfoodlogo.svg" alt="Find Food Logo" class="logo__img">
          <div class="logo__text">FindFood</div>
        </a>
        <a href="#" class="admin__link">Admin</a>
      </div>
    </div>
  </header>
  <main class="main">
    <div class="search__bar">
      <form action="">
        <input class="search__bar-input" type="text" value="" data-role="tagsinput" />
        <button type="submit"><img src="web/img/search.svg" alt="search"></button>
      </form>
    </div>
    <div class="food__results">
      <div class="container">
        <div class="foods__inner">
          <div class="food__cart">
            <img src="web/img/food1.png" alt="" class="food__img">
            <div class="food__name">Pizza</div>
            <div class="tags">
              <a href="#" class="tag">floor</a>
            </div>
          </div>
          <div class="food__cart">
            <img src="web/img/food2.png" alt="" class="food__img">
            <div class="food__name">Pizza</div>
            <div class="tags">
              <a href="#" class="tag">floor</a>
              <a href="#" class="tag">floor</a> <a href="#" class="tag">floor</a> <a href="#" class="tag">floor</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>